<?php

use Illuminate\Database\Seeder;
use App\model\LmsQuestion;
use App\model\LmsQuestionOption;
use App\model\LmsQuestionPaper;
use App\model\LmsQuestionPaperSection;
use App\model\LmsQuestionPaperItem;
use App\model\LmsQuiz;

class BtebComputerOfficeApplicationPaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Builds the official BTEB 60-mark, 1-hour Computer Office Application exam paper.
     */
    public function run()
    {
        // 1. Create or Find the Official Paper
        $paper = LmsQuestionPaper::firstOrNew([
            'paper_code'   => 'BTEB-2026-00076-A',
        ]);

        $paper->title            = 'কম্পিউটার অফিস অ্যাপ্লিকেশন (বিষয় কোড: ০০০৭৬)';
        $paper->board_name       = 'বাংলাদেশ কারিগরি শিক্ষা বোর্ড, ঢাকা';
        $paper->exam_name        = 'বেসিক ট্রেড ৩৬০ ঘণ্টা (৬ মাস ও ৩ মাস) মেয়াদি তাত্ত্বিক পরীক্ষা-২০২৬';
        $paper->subject_name     = 'কম্পিউটার অফিস অ্যাপ্লিকেশন';
        $paper->subject_code     = '00076';
        $paper->paper_set        = 'Set A';
        $paper->total_marks      = 60.0;
        $paper->duration_minutes = 60;
        $paper->instructions     = 'সকল প্রশ্নের উত্তর দিতে হবে। প্রশ্নপত্রে কোনো প্রকার দাগ বা চিহ্ন দেওয়া যাবে না।';
        $paper->status           = 'published';
        $paper->save();

        // 2. Setup 7 Official Sections
        $sec1 = LmsQuestionPaperSection::firstOrCreate([
            'paper_id'     => $paper->id,
            'section_code' => 'ক',
        ], [
            'title'              => 'অতি সংক্ষেপে উত্তর দাও',
            'instructions'       => 'সকল প্রশ্নের উত্তর সংক্ষেপে খাতায় লিখুন',
            'question_type'      => 'short_answer',
            'order_index'        => 1,
            'marks_per_question' => 1.0,
        ]);

        $sec2 = LmsQuestionPaperSection::firstOrCreate([
            'paper_id'     => $paper->id,
            'section_code' => 'খ',
        ], [
            'title'              => 'সঠিক শব্দ দিয়ে শূন্যস্থান পূরণ কর',
            'instructions'       => 'উপযুক্ত শব্দ বা সংখ্যা বসিয়ে বাক্যটি পূর্ণ করুন',
            'question_type'      => 'fill_blanks',
            'order_index'        => 2,
            'marks_per_question' => 1.0,
        ]);

        $sec3 = LmsQuestionPaperSection::firstOrCreate([
            'paper_id'     => $paper->id,
            'section_code' => 'গ',
        ], [
            'title'              => 'বাক্যটি সত্য হলে "স" এবং মিথ্যা হলে "মি" লেখ',
            'instructions'       => 'বিবৃতিটি সঠিক হলে সত্য (স) অথবা ভুল হলে মিথ্যা (মি) লিখুন',
            'question_type'      => 'true_false',
            'order_index'        => 3,
            'marks_per_question' => 1.0,
        ]);

        $sec4 = LmsQuestionPaperSection::firstOrCreate([
            'paper_id'     => $paper->id,
            'section_code' => 'ঘ',
        ], [
            'title'              => 'সঠিক উত্তরটি লেখ',
            'instructions'       => 'প্রদত্ত চারটির মধ্যে সর্বোৎকৃষ্ট উত্তরের বৃত্তটি পূরণ করুন',
            'question_type'      => 'mcq',
            'order_index'        => 4,
            'marks_per_question' => 1.0,
        ]);

        $sec5 = LmsQuestionPaperSection::firstOrCreate([
            'paper_id'     => $paper->id,
            'section_code' => 'ঙ',
        ], [
            'title'              => 'Answer the following questions in English',
            'instructions'       => 'Write your answer in English',
            'question_type'      => 'short_answer',
            'order_index'        => 5,
            'marks_per_question' => 1.0,
        ]);

        $sec6 = LmsQuestionPaperSection::firstOrCreate([
            'paper_id'     => $paper->id,
            'section_code' => 'চ',
        ], [
            'title'              => 'Translate into English',
            'instructions'       => 'বাংলা বাক্যগুলোর সঠিক ইংরেজি অনুবাদ লিখুন',
            'question_type'      => 'translation',
            'order_index'        => 6,
            'marks_per_question' => 1.0,
        ]);

        $sec7 = LmsQuestionPaperSection::firstOrCreate([
            'paper_id'     => $paper->id,
            'section_code' => 'ছ',
        ], [
            'title'              => 'Fill in the gaps using appropriate word',
            'instructions'       => 'ক্লু বা বিকল্প শব্দ থেকে সঠিক শব্দটি নির্বাচন করে শূন্যস্থান পূরণ করুন',
            'question_type'      => 'fill_blanks',
            'order_index'        => 7,
            'marks_per_question' => 1.0,
        ]);

        // Helper to add question to bank and paper item
        $orderCounter = 1;
        $addQ = function($sec, $qText, $qType, $ansText = null, $hints = null, $options = [], $chapter = 'কম্পিউটার ফান্ডামেন্টাল') use (&$orderCounter, $paper) {
            $q = LmsQuestion::firstOrNew([
                'question_text' => $qText,
                'question_type' => $qType,
            ]);
            $q->category = 'কম্পিউটার অফিস অ্যাপ্লিকেশন';
            $q->chapter = $chapter;
            $q->marks = 1.0;
            $q->correct_answer_text = $ansText;
            $q->hints = $hints;
            $q->is_active = true;
            $q->save();

            // Options if MCQ
            if (!empty($options)) {
                $q->options()->delete();
                foreach ($options as $idx => $opt) {
                    LmsQuestionOption::create([
                        'question_id' => $q->id,
                        'option_text' => $opt['text'],
                        'is_correct'  => !empty($opt['is_correct']),
                        'order_index' => $idx + 1,
                    ]);
                }
            }

            // Create Paper Item
            $item = LmsQuestionPaperItem::firstOrNew([
                'paper_id'    => $paper->id,
                'section_id'  => $sec->id,
                'question_id' => $q->id,
            ]);
            $item->order_index = $orderCounter++;
            $item->marks = 1.0;
            $item->save();
            $item->freezeSnapshot();

            return $q;
        };

        // =========================================================================
        // SECTION 1: অতি সংক্ষেপে উত্তর দাও (13 Questions)
        // =========================================================================
        $q1 = $addQ($sec1, 'সিস্টেম ইউনিট কী ?', 'short_answer', 'কম্পিউটারের মূল কার্যকারী যন্ত্রাংশগুলো যেমন সিপিইউ, মাদারবোর্ড, র‍্যাম, হার্ডডিস্ক ইত্যাদি যে বক্স বা চ্যাসিসে আবদ্ধ থাকে তাকে সিস্টেম ইউনিট বলে।');
        $addQ($sec1, 'কম্পিউটার মেমরি কী?', 'short_answer', 'কম্পিউটারে তথ্য, ডেটা ও নির্দেশনাবলি অস্থায়ী বা স্থায়ীভাবে জমা রাখার স্থান বা ধারণক্ষমতাকে মেমরি বলে।');
        $addQ($sec1, 'কাজের ধরন ও প্রকৃতির উপর ভিত্তি করে কম্পিউটারকে কয়ভাগে ভাগ করা যায়?', 'short_answer', '৩ ভাগে (অ্যানালগ, ডিজিটাল এবং হাইব্রিড কম্পিউটার)।');
        $addQ($sec1, 'বিট ও বাইট কী?', 'short_answer', 'বাইনারি সংখ্যা পদ্ধতির ০ ও ১ কে বিট (Bit) বলে এবং পরপর ৮টি বিট একত্রে মিলে এক বাইট (Byte) গঠিত হয়।');
        $addQ($sec1, 'রিসাইকেল বিন কী?', 'short_answer', 'কম্পিউটার থেকে মুছে ফেলা ফাইল বা ফোল্ডার সাময়িকভাবে সংরক্ষিত রাখার ভার্চুয়াল ডাস্টবিন বা বিশেষ ফোল্ডার।');
        $addQ($sec1, 'ফোল্ডার তৈরি করা হয় কিভাবে?', 'short_answer', 'মাউসের রাইট ক্লিক করে New -> Folder নির্বাচন করে অথবা কীবোর্ড শর্টকাট Ctrl + Shift + N চেপে।');
        $addQ($sec1, 'System Software কী?', 'short_answer', 'যে সফটওয়্যার কম্পিউটারের হার্ডওয়্যার নিয়ন্ত্রণ ও পরিচালনা করে এবং অ্যাপ্লিকেশন সফটওয়্যার চলার পরিবেশ তৈরি করে (যেমন: Windows OS)।');
        $addQ($sec1, 'ফরম্যাট পেইন্টারের কাজ কী?', 'short_answer', 'কোনো নির্দিষ্ট টেক্সট বা অবজেক্টের ফরম্যাটিং হুবহু কপি করে অন্য টেক্সট বা অবজেক্টে প্রয়োগ করা।');
        $addQ($sec1, 'ওয়ার্ডবুক কী?', 'short_answer', 'মাইক্রোসফট এক্সেলের তৈরি একটি স্প্রেডশিট ফাইল যাতে একাধিক ওয়ার্কশিট থাকে তাকে ওয়ার্কবুক বলে।');
        $addQ($sec1, 'SSD এর পূর্ণরূপ কী?', 'short_answer', 'Solid State Drive (সলিড স্টেট ড্রাইভ)।');
        $addQ($sec1, 'দুটি সার্চ ইঞ্জিনের নাম লেখ?', 'short_answer', 'Google এবং Bing (অথবা Yahoo)।');
        $addQ($sec1, 'স্লাইড কী ?', 'short_answer', 'মাইক্রোসফট পাওয়ারপয়েন্ট প্রেজেন্টেশনের একক পৃষ্ঠাকে স্লাইড (Slide) বলে।');
        $addQ($sec1, 'ফাংশন কী কাকে বলে?', 'short_answer', 'কী-বোর্ডের সবচেয়ে উপরের সারির F1 থেকে F12 পর্যন্ত বিশেষ কাজের জন্য নির্ধারিত ১২টি কী-কে ফাংশন কী বলে।');

        // =========================================================================
        // SECTION 2: সঠিক শব্দ দিয়ে শূন্যস্থান পূরণ কর (13 Questions)
        // =========================================================================
        $addQ($sec2, 'মেমরির একক হচ্ছে ........... ।', 'fill_blanks', 'বাইট, Byte');
        $addQ($sec2, 'ডাটাবেস রিলেশন ............ প্রকার।', 'fill_blanks', '৪, চার, 4');
        $addQ($sec2, 'ইলেকট্রনিক মেইলকে সংক্ষেপে ........... বলে।', 'fill_blanks', 'ই-মেইল, ইমেইল, Email, E-mail');
        $addQ($sec2, 'মাউসের মাধ্যমে ক্লিক করে ডাটা ......... করা হয়।', 'fill_blanks', 'সিলেক্ট, নির্বাচন, Select');
        $addQ($sec2, 'VIRUS শব্দের পূর্ণরূপ হলো ............ ।', 'fill_blanks', 'Vital Information Resources Under Siege');
        $addQ($sec2, 'কী-বোর্ড একটি ........... ডিভাইস', 'fill_blanks', 'ইনপুট, Input');
        $addQ($sec2, 'লিগ্যাল পেজের সাইজ দৈর্ঘ্য ......... ও প্রস্থ ......... ।', 'fill_blanks', '১৪" ও ৮.৫", 14" ও 8.5", 14 এবং 8.5');
        $addQ($sec2, 'কোন কিছু খোঁজার কী-বোর্ড কমান্ড ........... ।', 'fill_blanks', 'Ctrl + F, Ctrl+F');
        $addQ($sec2, 'Excel ওয়ার্কশিটে ডিফল্ট শিট সংখ্যা ........... টি', 'fill_blanks', '১, ৩, 1, 3');
        $addQ($sec2, 'প্রত্যেক ফাংশন .......... দিয়ে শুরু হয়।', 'fill_blanks', '=, সমান চিহ্ন, Equal');
        $addQ($sec2, 'পাওয়ার পয়েন্ট নতুন স্লাইড নেওয়ার জন্য ........... কী চাপতে হয়।', 'fill_blanks', 'Ctrl + M, Ctrl+M');
        $addQ($sec2, '১০ এর বাইনারি হলো ......... ।', 'fill_blanks', '১০১০, 1010');
        $addQ($sec2, 'BIOS এর পূর্ণরূপ ......... ।', 'fill_blanks', 'Basic Input Output System');

        // =========================================================================
        // SECTION 3: সত্য / মিথ্যা (12 Questions)
        // =========================================================================
        $addQ($sec3, 'অক্টাল পদ্ধতির ভিত্তি হচ্ছে ৮টি।', 'true_false', 'সত্য');
        $addQ($sec3, 'ROM স্থায়ী মেমরি।', 'true_false', 'সত্য');
        $addQ($sec3, 'কী-বোর্ডের কী-গুলোকে ৫ টি ভাগে ভাগ করা যায়।', 'true_false', 'সত্য');
        $addQ($sec3, 'Ctrl+S ফাইল Save করার কমান্ড।', 'true_false', 'সত্য');
        $addQ($sec3, 'লটার একটি কম্পিউটার ভাইরাস।', 'true_false', 'মিথ্যা');
        $addQ($sec3, 'G5 হতে K5 পর্যন্ত যোগ করার সঠিক নিয়ম হলো = Sum(G5 : K5)', 'true_false', 'সত্য');
        $addQ($sec3, 'Ctrl + Enter প্রেস করে পেজ ব্রেক করা যায়।', 'true_false', 'সত্য');
        $addQ($sec3, 'CD ও DVD এর মধ্যে কোন পার্থক্য নেই।', 'true_false', 'মিথ্যা');
        $addQ($sec3, 'Ctrl + W কী-বোর্ড কমান্ড দিয়ে ডকুমেন্টকে ক্লোজ করা হয়।', 'true_false', 'সত্য');
        $addQ($sec3, 'কম্পিউটারের প্রজন্ম ৩ টি।', 'true_false', 'মিথ্যা');
        $addQ($sec3, '১৯৭১ সালে মাইক্রোপ্রসেসর আবিষ্কার হয়।', 'true_false', 'সত্য');
        $addQ($sec3, 'SutonnyMJ একটি বাংলা সফ্টওয়্যারের নাম।', 'true_false', 'মিথ্যা'); // SutonnyMJ is a Font, not Software (Bijoy is software)

        // =========================================================================
        // SECTION 4: বহুনির্বাচনি প্রশ্ন (MCQ - 12 Questions)
        // =========================================================================
        $addQ($sec4, 'ডেস্কটপের আইকন নয় কোনটি?', 'mcq', null, null, [
            ['text' => 'My Computer', 'is_correct' => false],
            ['text' => 'My Document', 'is_correct' => false],
            ['text' => 'Recycle Bin', 'is_correct' => false],
            ['text' => 'My File', 'is_correct' => true],
        ]);

        $addQ($sec4, 'হিসাবসংক্রান্ত সফটওয়্যার কোনটি ?', 'mcq', null, null, [
            ['text' => 'PC DOS', 'is_correct' => false],
            ['text' => 'MS Access', 'is_correct' => false],
            ['text' => 'MS Word', 'is_correct' => false],
            ['text' => 'MS Excel', 'is_correct' => true],
        ]);

        $addQ($sec4, 'বিজয় ক্লাসিক চালু করতে কী-বোর্ডের কোন কী চাপতে হয়?', 'mcq', null, null, [
            ['text' => 'Ctrl + B', 'is_correct' => false],
            ['text' => 'Ctrl + C', 'is_correct' => false],
            ['text' => 'Ctrl + Alt + B', 'is_correct' => true],
            ['text' => 'Ctrl +Alt +V', 'is_correct' => false],
        ]);

        $addQ($sec4, 'পেন ড্রাইভ একটি -?', 'mcq', null, null, [
            ['text' => 'Input Device', 'is_correct' => false],
            ['text' => 'Input/Output Device', 'is_correct' => true],
            ['text' => 'Output Device', 'is_correct' => false],
            ['text' => 'উল্লিখিত কোনটিই নয়', 'is_correct' => false],
        ]);

        $addQ($sec4, 'কত বাইট = ১ কিলোবাইট?', 'mcq', null, null, [
            ['text' => '১০৪৪ বাইট', 'is_correct' => false],
            ['text' => '১০২৫ বাইট', 'is_correct' => false],
            ['text' => '১০২৪ বাইট', 'is_correct' => true],
            ['text' => '১০৪০ বাইট', 'is_correct' => false],
        ]);

        $addQ($sec4, 'প্রিন্ট এর কী বোর্ড কমান্ড কোনটি?', 'mcq', null, null, [
            ['text' => 'Ctrl + W', 'is_correct' => false],
            ['text' => 'Ctrl + O', 'is_correct' => false],
            ['text' => 'Ctrl + P', 'is_correct' => true],
            ['text' => 'Ctrl + N', 'is_correct' => false],
        ]);

        $addQ($sec4, 'Undo এর কী বোর্ড কমান্ড কোনটি ?', 'mcq', null, null, [
            ['text' => 'Ctrl + Y', 'is_correct' => false],
            ['text' => 'Ctrl + Z', 'is_correct' => true],
            ['text' => 'Ctrl + W', 'is_correct' => false],
            ['text' => 'Ctrl + O', 'is_correct' => false],
        ]);

        $addQ($sec4, 'কোনটি লজিক্যাল Function ?', 'mcq', null, null, [
            ['text' => '=IF', 'is_correct' => true],
            ['text' => '=Sum', 'is_correct' => false],
            ['text' => '=Avg', 'is_correct' => false],
            ['text' => '= MOD ( )', 'is_correct' => false],
        ]);

        $addQ($sec4, 'নিচের কোনটি সহায়ক মেমোরি নয়?', 'mcq', null, null, [
            ['text' => 'Pen Drive', 'is_correct' => false],
            ['text' => 'CD Disk', 'is_correct' => false],
            ['text' => 'Hard Disk', 'is_correct' => false],
            ['text' => 'Rom', 'is_correct' => true],
        ]);

        $addQ($sec4, 'A4 Size এর কাগজের মাপ বা পরিমাপ কোনটি?', 'mcq', null, null, [
            ['text' => '8.26" x 11.67"', 'is_correct' => false],
            ['text' => '8.27" x 11.69"', 'is_correct' => true],
            ['text' => '8.30" x 11.50"', 'is_correct' => false],
            ['text' => '8.5" x 14.00"', 'is_correct' => false],
        ]);

        $addQ($sec4, 'WWW এর পূর্ণরূপ কী?', 'mcq', null, null, [
            ['text' => 'World Wide Web', 'is_correct' => true],
            ['text' => 'Word Wide Wen', 'is_correct' => false],
            ['text' => 'Word Web Wide', 'is_correct' => false],
            ['text' => 'Word Wide Wand', 'is_correct' => false],
        ]);

        $addQ($sec4, '৪১ দশমিক সংখ্যার বাইনারি কোনটি?', 'mcq', null, null, [
            ['text' => '(১০১০১০)২', 'is_correct' => false],
            ['text' => '(১০১০০১)২', 'is_correct' => true],
            ['text' => '(১১০১০১)২', 'is_correct' => false],
            ['text' => '(১০১১০১)২', 'is_correct' => false],
        ]);

        // =========================================================================
        // SECTION 5: English Short Questions (2 Questions)
        // =========================================================================
        $addQ($sec5, 'What is your Nationality?', 'short_answer', 'Bangladeshi');
        $addQ($sec5, 'How Many Seasons in Bangladesh?', 'short_answer', 'There are six seasons in Bangladesh.');

        // =========================================================================
        // SECTION 6: Translate into English (5 Questions)
        // =========================================================================
        $addQ($sec6, 'সূর্য পূর্বদিকে ওঠে এবং পশ্চিম দিকে অস্ত যায়।', 'translation', 'The sun rises in the east and sets in the west.');
        $addQ($sec6, 'গুঁড়ি গুঁড়ি বৃষ্টি পড়ছে', 'translation', 'It is drizzling.');
        $addQ($sec6, 'করিম পাঁচ বছর যাবৎ এই স্কুলে পড়ে।', 'translation', 'Karim has been reading in this school for five years.');
        $addQ($sec6, 'গনি মিঞা একজন গরিব কৃষক', 'translation', 'Gani Mia is a poor farmer.');
        $addQ($sec6, 'ডাক্তার আসার পূর্বে রোগী মারা গেল', 'translation', 'The patient had died before the doctor came.');

        // =========================================================================
        // SECTION 7: Fill in the gaps using appropriate word (3 Questions)
        // =========================================================================
        $addQ($sec7, 'He ............. a good boy.', 'fill_blanks', 'is', 'am/is/are');
        $addQ($sec7, 'Dhaka stands on .............. Borigonga river.', 'fill_blanks', 'the', 'a/on/the');
        $addQ($sec7, 'Look .............. the top of the gage.', 'fill_blanks', 'at', 'on/at/in');

        // =========================================================================
        // 3. Demonstrate Related / Derived Question Engine
        // Take Q1 "সিস্টেম ইউনিট কী ?" and derive True/False and Fill-in-the-blanks versions
        // =========================================================================
        $derivedTf = LmsQuestion::firstOrNew([
            'parent_question_id' => $q1->id,
            'question_type'      => 'true_false',
        ]);
        $derivedTf->question_text = 'কম্পিউটারের মূল কার্যকারী যন্ত্রাংশগুলো যে বাক্সে সংরক্ষিত থাকে তাকে সিস্টেম ইউনিট বলে।';
        $derivedTf->category = 'কম্পিউটার অফিস অ্যাপ্লিকেশন';
        $derivedTf->chapter = 'কম্পিউটার ফান্ডামেন্টাল';
        $derivedTf->marks = 1.0;
        $derivedTf->correct_answer_text = 'সত্য';
        $derivedTf->is_active = true;
        $derivedTf->save();

        $derivedFill = LmsQuestion::firstOrNew([
            'parent_question_id' => $q1->id,
            'question_type'      => 'fill_blanks',
        ]);
        $derivedFill->question_text = 'সিপিইউ, মাদারবোর্ড ও মেমরি ধারণকারী বক্সকে ............. বলে।';
        $derivedFill->category = 'কম্পিউটার অফিস অ্যাপ্লিকেশন';
        $derivedFill->chapter = 'কম্পিউটার ফান্ডামেন্টাল';
        $derivedFill->marks = 1.0;
        $derivedFill->correct_answer_text = 'সিস্টেম ইউনিট, System Unit';
        $derivedFill->is_active = true;
        $derivedFill->save();

        // 4. Link Question Paper to Online Quiz for Student Portal
        $quiz = LmsQuiz::firstOrNew([
            'paper_id' => $paper->id,
        ]);
        $quiz->title            = 'BTEB অফিসিয়াল মডেল টেস্ট: কম্পিউটার অফিস অ্যাপ্লিকেশন (কোড: ০০০৭৬)';
        $quiz->quiz_type        = 'exam';
        $quiz->duration_minutes = 60;
        $quiz->total_marks      = 60.0;
        $quiz->pass_marks       = 24.0;
        $quiz->max_attempts     = 5;
        $quiz->is_published     = true;
        $quiz->shuffle_questions = false;
        $quiz->shuffle_options  = false;
        $quiz->description      = 'বাংলাদেশ কারিগরি শিক্ষা বোর্ডের ৬ মাস ও ৩ মাস মেয়াদি কম্পিউটার অফিস অ্যাপ্লিকেশন কোর্সের অফিসিয়াল প্রশ্নপত্রের আদলে নির্মিত পূর্ণাঙ্গ ৬০ নম্বরের পরীক্ষা।';
        $quiz->save();

        $paper->recalculateTotals();
    }
}
