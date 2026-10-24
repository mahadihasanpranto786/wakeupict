<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\model\LmsQuestion;
use App\model\LmsQuestionOption;
use App\model\LmsQuiz;
use App\model\LmsQuizAttempt;
use App\model\LmsQuizAnswer;
use App\model\StudentAccount;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ConceptBasedExplanationSystemTest extends TestCase
{
    protected function getAdmin()
    {
        return User::first() ?: User::create([
            'name' => 'Admin Tester',
            'email' => 'admin_test_' . rand(1000, 9999) . '@test.com',
            'password' => Hash::make('password123'),
            'excess_type' => 'admin',
        ]);
    }

    protected function getStudent()
    {
        return StudentAccount::create([
            'student_id_code' => StudentAccount::generateUniqueStudentId(),
            'name' => 'কনসেপ্ট শিক্ষার্থী',
            'phone' => '017' . rand(10000000, 99999999),
            'email' => 'concept_student_' . rand(1000, 9999) . '@test.com',
            'password' => Hash::make('secret123'),
            'status' => 1,
        ]);
    }

    /**
     * Test storing and retrieving concept-based explanation fields
     */
    public function test_question_can_store_and_retrieve_concept_based_explanations()
    {
        $q = LmsQuestion::create([
            'question_text'        => 'কম্পিউটারের জনক কে?',
            'question_type'        => 'mcq_single',
            'marks'                => 1.0,
            'concept_title'        => 'কম্পিউটারের জনক ও ইতিহাস',
            'explanation'          => 'সঠিক উত্তর চার্লস ব্যাবেজ।',
            'concept_explanation'  => 'চার্লস ব্যাবেজ ১৮৩৩ সালে অ্যানালাইটিক্যাল ইঞ্জিনের নকশা তৈরি করেন।',
            'why_other_options_wrong' => 'অ্যালান টুরিং হলেন আধুনিক কম্পিউটারের জনক।',
            'common_mistakes'      => 'ব্যাবেজ ও টুরিংকে গুলিয়ে ফেলা পরীক্ষার অন্যতম সাধারণ ভুল।',
            'memory_aid'           => 'ব্যাবেজ = বেইজ (ভিত্তি)।',
            'explanation_status'   => 'verified',
            'is_active'            => true,
        ]);

        $this->assertTrue($q->hasEducationalExplanation());
        $this->assertEquals('কম্পিউটারের জনক ও ইতিহাস', $q->getEffectiveConceptTitle());
        $this->assertEquals('চার্লস ব্যাবেজ ১৮৩৩ সালে অ্যানালাইটিক্যাল ইঞ্জিনের নকশা তৈরি করেন।', $q->getEffectiveConceptExplanation());
        $this->assertEquals('ব্যাবেজ = বেইজ (ভিত্তি)।', $q->getEffectiveMemoryAid());
        $this->assertStringContainsString('যাচাইকৃত', $q->getExplanationStatusBadge());
    }

    /**
     * Test derived questions automatically inherit concept explanations from root question
     */
    public function test_derived_question_inherits_concept_explanation_from_parent()
    {
        $root = LmsQuestion::create([
            'question_text'       => 'Computer শব্দের অর্থ কী?',
            'question_type'       => 'mcq_single',
            'marks'               => 1.0,
            'concept_title'       => 'কম্পিউটার ব্যুৎপত্তি ও শাব্দিক অর্থ',
            'concept_explanation' => 'কম্পিউটার শব্দের অর্থ গণনাকারী যন্ত্র। গ্রিক শব্দ Compute থেকে উৎপত্তি।',
            'common_mistakes'     => 'কম্পিউটার মানে শুধু টাইপিং মেশিন নয়।',
            'memory_aid'          => 'Compute + er = Computer',
            'explanation_status'  => 'verified',
            'is_active'           => true,
        ]);

        $derivedTf = LmsQuestion::create([
            'parent_question_id'  => $root->id,
            'question_text'       => 'Computer শব্দের অর্থ গণনাকারী যন্ত্র।',
            'question_type'       => 'true_false',
            'marks'               => 1.0,
            'correct_answer_text' => 'true',
            'explanation'         => 'উক্তিটি সত্য।',
            'is_active'           => true,
        ]);

        // Effective properties should fall back to parent question
        $this->assertEquals('কম্পিউটার ব্যুৎপত্তি ও শাব্দিক অর্থ', $derivedTf->getEffectiveConceptTitle());
        $this->assertEquals('কম্পিউটার শব্দের অর্থ গণনাকারী যন্ত্র। গ্রিক শব্দ Compute থেকে উৎপত্তি।', $derivedTf->getEffectiveConceptExplanation());
        $this->assertEquals('Compute + er = Computer', $derivedTf->getEffectiveMemoryAid());
        $this->assertEquals('কম্পিউটার মানে শুধু টাইপিং মেশিন নয়।', $derivedTf->getEffectiveCommonMistakes());
    }

    /**
     * Test finding related questions across multiple formats
     */
    public function test_related_concept_questions_finds_sibling_and_parent_variations()
    {
        $uniqueConcept = 'টেস্ট ডিজিটাল ডেটার পরিমাপ ' . uniqid();

        $root = LmsQuestion::create([
            'question_text' => 'বিট ও বাইট কী?',
            'question_type' => 'short_answer',
            'marks'         => 1.0,
            'concept_title' => $uniqueConcept,
            'is_active'     => true,
        ]);

        $mcq = LmsQuestion::create([
            'parent_question_id' => $root->id,
            'question_text'      => '১ বাইট সমান কত বিট?',
            'question_type'      => 'mcq_single',
            'marks'              => 1.0,
            'concept_title'      => $uniqueConcept,
            'correct_answer_text'=> '৮ বিট',
            'is_active'          => true,
        ]);

        $fib = LmsQuestion::create([
            'parent_question_id' => $root->id,
            'question_text'      => '৮ বিট সমান ________ বাইট।',
            'question_type'      => 'fill_blanks',
            'marks'              => 1.0,
            'concept_title'      => $uniqueConcept,
            'correct_answer_text'=> '১',
            'is_active'          => true,
        ]);

        $relatedToRoot = $root->getRelatedConceptQuestions();
        $this->assertTrue($relatedToRoot->contains('id', $mcq->id));
        $this->assertTrue($relatedToRoot->contains('id', $fib->id));

        $relatedToMcq = $mcq->getRelatedConceptQuestions();
        $this->assertTrue($relatedToMcq->contains('id', $root->id));
        $this->assertTrue($relatedToMcq->contains('id', $fib->id));
    }

    /**
     * Test Question Bank preview endpoint returns full concept explanation payload
     */
    public function test_question_book_preview_endpoint_returns_concept_explanation_payload()
    {
        $admin = $this->getAdmin();
        $q = LmsQuestion::create([
            'question_text'       => 'SSD এর পূর্ণরূপ কী?',
            'question_type'       => 'short_answer',
            'marks'               => 1.0,
            'concept_title'       => 'সলিড স্টেট ড্রাইভ (SSD vs HDD)',
            'explanation'         => 'Solid State Drive',
            'concept_explanation' => 'SSD ফ্ল্যাশ মেমোরি ভিত্তিক সেকেন্ডারি স্টোরেজ।',
            'memory_aid'          => 'Solid State = কোনো মুভিং পার্টস নেই।',
            'explanation_status'  => 'verified',
            'is_active'           => true,
        ]);

        $response = $this->actingAs($admin)->getJson("/admin/question-book/{$q->id}/preview");
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'question' => [
                'id'                  => $q->id,
                'concept_title'       => 'সলিড স্টেট ড্রাইভ (SSD vs HDD)',
                'concept_explanation' => 'SSD ফ্ল্যাশ মেমোরি ভিত্তিক সেকেন্ডারি স্টোরেজ।',
                'memory_aid'          => 'Solid State = কোনো মুভিং পার্টস নেই।',
                'explanation_status'  => 'verified',
            ]
        ]);
    }

    /**
     * Test Student Quiz Result View renders Concept-Based Bengali Learning Card
     */
    public function test_student_quiz_result_view_displays_concept_based_bengali_learning_card()
    {
        $student = $this->getStudent();

        $quiz = LmsQuiz::create([
            'title'               => 'কনসেপ্ট ভিত্তিক শিখন টেস্ট পরীক্ষা',
            'duration_minutes'    => 30,
            'total_marks'         => 10,
            'pass_marks'          => 4,
            'is_published'        => true,
            'view_mode'           => 'all_questions',
            'locking_policy'      => 'instant_lock',
            'result_release_policy' => 'immediate',
        ]);

        $q = LmsQuestion::create([
            'quiz_id'             => $quiz->id,
            'question_text'       => 'Computer শব্দের অর্থ কী ?',
            'question_type'       => 'mcq_single',
            'marks'               => 1.0,
            'concept_title'       => 'কম্পিউটারের উৎপত্তি ও শাব্দিক অর্থ',
            'explanation'         => 'Computer শব্দের আভিধানিক অর্থ গণনাকারী যন্ত্র।',
            'concept_explanation' => 'কম্পিউটার একটি স্বয়ংক্রিয় ইলেকট্রনিক তথ্য প্রক্রিয়াকরণ যন্ত্র।',
            'why_other_options_wrong' => 'মুদ্রণ যন্ত্র হলো প্রিন্টার।',
            'common_mistakes'     => 'কম্পিউটারকে শুধু টাইপিং মেশিন মনে করা যাবে না।',
            'memory_aid'          => 'Compute + er = Computer',
            'explanation_status'  => 'verified',
            'is_active'           => true,
        ]);

        $optA = LmsQuestionOption::create([
            'question_id' => $q->id,
            'option_text' => 'গণনাকারী যন্ত্র',
            'is_correct'  => true,
            'order_index' => 1,
        ]);

        $optB = LmsQuestionOption::create([
            'question_id' => $q->id,
            'option_text' => 'মুদ্রণ যন্ত্র',
            'is_correct'  => false,
            'order_index' => 2,
        ]);

        $attempt = LmsQuizAttempt::create([
            'quiz_id'             => $quiz->id,
            'student_account_id'  => $student->id,
            'attempt_number'      => 1,
            'status'              => 'graded',
            'score'               => 1.0,
            'total_marks'         => 1.0,
            'percentage'          => 100.0,
            'started_at'          => Carbon::now()->subMinutes(1),
            'submitted_at'        => Carbon::now(),
            'time_spent_seconds'  => 45,
            'questions_snapshot'  => [
                [
                    'id'            => $q->id,
                    'question_text' => $q->question_text,
                    'question_type' => 'mcq_single',
                    'marks'         => 1.0,
                ]
            ],
        ]);

        LmsQuizAnswer::create([
            'attempt_id'          => $attempt->id,
            'question_id'         => $q->id,
            'selected_option_ids' => json_encode([$optA->id]),
            'is_correct'          => true,
            'marks_obtained'      => 1.0,
            'is_finalized'        => true,
        ]);

        $response = $this->actingAs($student, 'student')
            ->get("/student/quiz/attempt/{$attempt->id}/results");

        $response->assertStatus(200);
        $response->assertSee('কনসেপ্টভিত্তিক বিশদ ব্যাখ্যা ও শিখন');
        $response->assertSee('কম্পিউটারের উৎপত্তি ও শাব্দিক অর্থ');
        $response->assertSee('Computer শব্দের আভিধানিক অর্থ গণনাকারী যন্ত্র।');
        $response->assertSee('কম্পিউটার একটি স্বয়ংক্রিয় ইলেকট্রনিক তথ্য প্রক্রিয়াকরণ যন্ত্র।');
        $response->assertSee('যাচাইকৃত (Verified by ICT Faculty)');
    }

    /**
     * Confirm existing MCQs in bank remain safe and protected
     */
    public function test_existing_mcqs_remain_intact()
    {
        $q1 = LmsQuestion::find(1);
        $this->assertNotNull($q1, 'Question #1 must exist');
        $this->assertStringContainsString('Computer', $q1->question_text);
        $this->assertTrue(LmsQuestion::count() >= 347, 'All 347 original MCQs must remain intact');
    }
}
