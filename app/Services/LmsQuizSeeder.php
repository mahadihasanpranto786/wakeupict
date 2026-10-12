<?php

namespace App\Services;

use App\model\Course;
use App\model\LmsChapter;
use App\model\LmsQuiz;
use App\model\LmsQuestion;
use App\model\LmsQuestionOption;

class LmsQuizSeeder
{
    public static function seedQuizzes()
    {
        // 1. Academic ICT (Classes 6-10)
        $academicCourse = Course::where('course_slug', 'academic-ict-classes-6-10')->first();
        if ($academicCourse) {
            self::seedAcademicIctQuizzes($academicCourse->id);
        }

        // 2. Web Design & Development (Course ID 3)
        $webCourse = Course::where('id', 3)->orWhere('course_slug', 'LIKE', '%web-design%')->first();
        if ($webCourse) {
            self::seedWebDevQuiz($webCourse->id);
        }

        // 3. Graphic Design (Course ID 1)
        $graphicCourse = Course::where('id', 1)->orWhere('course_slug', 'LIKE', '%graphic%')->first();
        if ($graphicCourse) {
            self::seedGraphicDesignQuiz($graphicCourse->id);
        }

        // 4. Microsoft Office (Course ID 10)
        $officeCourse = Course::where('id', 10)->orWhere('course_slug', 'LIKE', '%office%')->first();
        if ($officeCourse) {
            self::seedMicrosoftOfficeQuiz($officeCourse->id);
        }

        // 5. Artificial Intelligence (AI)
        $aiCourse = Course::where('course_slug', 'artificial-intelligence-course-rajbari')->first();
        if ($aiCourse) {
            self::seedArtificialIntelligenceQuiz($aiCourse->id);
        }
    }

    protected static function seedAcademicIctQuizzes($courseId)
    {
        if (LmsQuiz::where('course_id', $courseId)->where('class_level', 'Class 6-7')->count() === 0) {
            $quiz1 = LmsQuiz::create([
                'course_id' => $courseId,
                'title' => 'Class 6 & 7 ICT: তথ্য ও যোগাযোগ প্রযুক্তি এবং নিরাপদ ব্যবহার',
                'description' => 'জাতীয় শিক্ষাক্রম ও পাঠ্যপুস্তক বোর্ড (NCTB) নির্ধারিত ৬ষ্ঠ ও ৭ম শ্রেণির আইসিটি পাঠ্যবই ভিত্তিক মডেল টেস্ট।',
                'quiz_type' => 'practice',
                'class_level' => 'Class 6-7',
                'duration_minutes' => 15,
                'total_marks' => 20,
                'pass_marks' => 8,
                'max_attempts' => 0, // unlimited practice
                'is_published' => true,
            ]);

            self::addQuestion($quiz1->id, 'কম্পিউটারের প্রধান ইনপুট ডিভাইস কোনটি?', 5, 'কীবোর্ড হলো কম্পিউটারের সবচেয়ে বহুল ব্যবহৃত প্রাথমিক ইনপুট ডিভাইস।', [
                ['text' => 'কীবোর্ড (Keyboard)', 'correct' => true],
                ['text' => 'মনিটর (Monitor)', 'correct' => false],
                ['text' => 'প্রিন্টার (Printer)', 'correct' => false],
                ['text' => 'স্পিকার (Speaker)', 'correct' => false],
            ]);

            self::addQuestion($quiz1->id, 'নিচের কোনটি কম্পিউটারের ভাইরাস থেকে রক্ষা পেতে ব্যবহৃত হয়?', 5, 'অ্যান্টিভাইরাস সফটওয়্যার ম্যালওয়্যার ও ক্ষতিকর প্রোগ্রাম শনাক্ত এবং নির্মূল করে।', [
                ['text' => 'অ্যান্টিভাইরাস সফটওয়্যার (Antivirus)', 'correct' => true],
                ['text' => 'অপারেটিং সিস্টেম (OS)', 'correct' => false],
                ['text' => 'ফটোশপ (Photoshop)', 'correct' => false],
                ['text' => 'স্প্রেডশিট (Spreadsheet)', 'correct' => false],
            ]);

            self::addQuestion($quiz1->id, 'RAM (Random Access Memory) একটি স্থায়ী মেমরি। এই উক্তিটি সত্য না মিথ্যা?', 5, 'র‍্যাম একটি অস্থায়ী (Volatile) মেমরি, বিদ্যুৎ চলে গেলে এর তথ্য মুছে যায়।', [
                ['text' => 'মিথ্যা (False)', 'correct' => true],
                ['text' => 'সত্য (True)', 'correct' => false],
            ], 'true_false');

            self::addQuestion($quiz1->id, 'ইন্টারনেটে নিরাপদে ব্রাউজ করার জন্য কোনটি অপরিহার্য?', 5, 'শক্তিশালী পাসওয়ার্ড ও নিরাপদ লিঙ্ক সচেতনতা অত্যন্ত জরুরি।', [
                ['text' => 'শক্তিশালী গোপন পাসওয়ার্ড ও নিরাপদ ওয়েবসাইট ব্যবহার', 'correct' => true],
                ['text' => 'যেকোনো লিংকে ক্লিক করা', 'correct' => false],
                ['text' => 'পাসওয়ার্ড সবার সাথে শেয়ার করা', 'correct' => false],
                ['text' => 'কম্পিউটার সবসময় রিস্টার্ট দেওয়া', 'correct' => false],
            ]);
        }

        if (LmsQuiz::where('course_id', $courseId)->where('class_level', 'Class 8-10')->count() === 0) {
            $quiz2 = LmsQuiz::create([
                'course_id' => $courseId,
                'title' => 'Class 8, 9 ও 10 ICT: বোর্ড স্ট্যান্ডার্ড মডেল টেস্ট (SSC ICT Exam)',
                'description' => '৮ম, ৯ম ও ১০ম শ্রেণি এবং এসএসসি বোর্ড পরীক্ষার পূর্ণাঙ্গ বহুনিবার্চনী প্রস্তুতি টেস্ট।',
                'quiz_type' => 'exam',
                'class_level' => 'Class 8-10',
                'duration_minutes' => 20,
                'total_marks' => 25,
                'pass_marks' => 10,
                'max_attempts' => 3,
                'is_published' => true,
            ]);

            self::addQuestion($quiz2->id, 'কোন নেটওয়ার্ক টপোলজিতে একটি কেন্দ্রীয় হাব বা সুইচ ব্যবহার করা হয়?', 5, 'স্টার টপোলজিতে (Star Topology) সকল নোড কেন্দ্রীয় সুইচ বা হাবের সাথে সংযুক্ত থাকে।', [
                ['text' => 'স্টার টপোলজি (Star Topology)', 'correct' => true],
                ['text' => 'বাস টপোলজি (Bus Topology)', 'correct' => false],
                ['text' => 'রিং টপোলজি (Ring Topology)', 'correct' => false],
                ['text' => 'মেশ টপোলজি (Mesh Topology)', 'correct' => false],
            ]);

            self::addQuestion($quiz2->id, 'স্প্রেডশিট সফটওয়্যারে (MS Excel) যোগ করার সঠিক ফর্মুলা কোনটি?', 5, 'এক্সেল ফর্মুলা সবসময় সমান চিহ্ন (=) দিয়ে শুরু হয় এবং সেল রেঞ্জ নির্দেশ করে।', [
                ['text' => '=SUM(A1:A10)', 'correct' => true],
                ['text' => 'ADD(A1:A10)', 'correct' => false],
                ['text' => '=TOTAL(A1:A10)', 'correct' => false],
                ['text' => '=PLUS(A1:A10)', 'correct' => false],
            ]);

            self::addQuestion($quiz2->id, 'ডিজিটাল নিরাপত্তা আইন অনুসারে অনুমতি ছাড়া অন্যের সিস্টেমে অনধিকার প্রবেশকে কী বলা হয়?', 5, 'অননুমোদিত প্রবেশ ও সাইবার অনুপ্রবেশকে হ্যাকিং বা সাইবার ক্রাইম বলা হয়।', [
                ['text' => 'হ্যাকিং (Hacking)', 'correct' => true],
                ['text' => 'ডাউনলোডিং (Downloading)', 'correct' => false],
                ['text' => 'আপলোডিং (Uploading)', 'correct' => false],
                ['text' => 'সার্চিং (Searching)', 'correct' => false],
            ]);

            self::addQuestion($quiz2->id, 'ওয়েব পেজ তৈরির জন্য বহুল ব্যবহৃত মূল মার্কআপ ভাষা কোনটি?', 5, 'HTML (HyperText Markup Language) ওয়েবপেজের মূল কাঠামো নির্মাণে ব্যবহৃত হয়।', [
                ['text' => 'HTML (HyperText Markup Language)', 'correct' => true],
                ['text' => 'HTTP', 'correct' => false],
                ['text' => 'URL', 'correct' => false],
                ['text' => 'FTP', 'correct' => false],
            ]);

            self::addQuestion($quiz2->id, 'নিচের কোনটি রিলেশনাল ডেটাবেজ ম্যানেজমেন্ট সফটওয়্যার (RDBMS)?', 5, 'মাইক্রোসফট এক্সেস এবং ওরাকল হলো রিলেশনাল ডেটাবেজ সফটওয়্যার।', [
                ['text' => 'Microsoft Access', 'correct' => true],
                ['text' => 'Microsoft Word', 'correct' => false],
                ['text' => 'Microsoft PowerPoint', 'correct' => false],
                ['text' => 'Adobe Illustrator', 'correct' => false],
            ]);
        }
    }

    protected static function seedWebDevQuiz($courseId)
    {
        if (LmsQuiz::where('course_id', $courseId)->count() === 0) {
            $quiz = LmsQuiz::create([
                'course_id' => $courseId,
                'title' => 'Web Development Foundation Quiz: HTML5, CSS3 & Responsive Design',
                'description' => 'Test your understanding of modern semantic HTML, CSS Flexbox/Grid, and web layouts.',
                'quiz_type' => 'chapter_quiz',
                'class_level' => 'Professional',
                'duration_minutes' => 15,
                'total_marks' => 20,
                'pass_marks' => 10,
                'max_attempts' => 0,
                'is_published' => true,
            ]);

            self::addQuestion($quiz->id, 'Which HTML5 element represents self-contained content, such as a blog post or news story?', 5, 'The <article> element is intended for standalone, independently distributable content.', [
                ['text' => '<article>', 'correct' => true],
                ['text' => '<section>', 'correct' => false],
                ['text' => '<div>', 'correct' => false],
                ['text' => '<aside>', 'correct' => false],
            ]);

            self::addQuestion($quiz->id, 'Which CSS property is used to align flex items along the cross axis?', 5, 'align-items aligns items along the cross axis, while justify-content aligns along the main axis.', [
                ['text' => 'align-items', 'correct' => true],
                ['text' => 'justify-content', 'correct' => false],
                ['text' => 'flex-direction', 'correct' => false],
                ['text' => 'align-content', 'correct' => false],
            ]);

            self::addQuestion($quiz->id, 'In CSS Box Model, which layer is outermost?', 5, 'The box model layers from inside out are: Content -> Padding -> Border -> Margin.', [
                ['text' => 'Margin', 'correct' => true],
                ['text' => 'Border', 'correct' => false],
                ['text' => 'Padding', 'correct' => false],
                ['text' => 'Outline', 'correct' => false],
            ]);

            self::addQuestion($quiz->id, 'JavaScript is a server-only programming language. True or False?', 5, 'JavaScript was created as a client-side browser scripting language and later expanded to server-side (Node.js).', [
                ['text' => 'False', 'correct' => true],
                ['text' => 'True', 'correct' => false],
            ], 'true_false');
        }
    }

    protected static function seedGraphicDesignQuiz($courseId)
    {
        if (LmsQuiz::where('course_id', $courseId)->count() === 0) {
            $quiz = LmsQuiz::create([
                'course_id' => $courseId,
                'title' => 'Graphic Design Core Quiz: Photoshop & Visual Principles',
                'description' => 'Assess your knowledge on color models, image resolution, and non-destructive editing.',
                'quiz_type' => 'practice',
                'class_level' => 'Professional',
                'duration_minutes' => 15,
                'total_marks' => 20,
                'pass_marks' => 10,
                'max_attempts' => 0,
                'is_published' => true,
            ]);

            self::addQuestion($quiz->id, 'What is the recommended resolution (DPI/PPI) for standard commercial print projects?', 5, '300 DPI is the standard resolution for high-quality commercial print, whereas 72 PPI is typical for digital screens.', [
                ['text' => '300 DPI', 'correct' => true],
                ['text' => '72 DPI', 'correct' => false],
                ['text' => '150 DPI', 'correct' => false],
                ['text' => '600 DPI', 'correct' => false],
            ]);

            self::addQuestion($quiz->id, 'Which color mode is primarily used for physical offset and digital printing?', 5, 'CMYK (Cyan, Magenta, Yellow, Key/Black) is subtractive color used for printing.', [
                ['text' => 'CMYK', 'correct' => true],
                ['text' => 'RGB', 'correct' => false],
                ['text' => 'Grayscale', 'correct' => false],
                ['text' => 'Lab Color', 'correct' => false],
            ]);

            self::addQuestion($quiz->id, 'In Adobe Photoshop, what does black color do on a Layer Mask?', 5, 'On a layer mask: Black conceals (hides), white reveals (shows), and grey gives transparency.', [
                ['text' => 'Hides / conceals the corresponding pixels', 'correct' => true],
                ['text' => 'Reveals / shows the pixels', 'correct' => false],
                ['text' => 'Deletes the layer permanently', 'correct' => false],
                ['text' => 'Inverts color saturation', 'correct' => false],
            ]);

            self::addQuestion($quiz->id, 'Vector graphics lose quality when enlarged to very large sizes. True or False?', 5, 'Vector graphics are mathematically defined and retain crisp resolution at any scale.', [
                ['text' => 'False', 'correct' => true],
                ['text' => 'True', 'correct' => false],
            ], 'true_false');
        }
    }

    protected static function seedMicrosoftOfficeQuiz($courseId)
    {
        if (LmsQuiz::where('course_id', $courseId)->count() === 0) {
            $quiz = LmsQuiz::create([
                'course_id' => $courseId,
                'title' => 'Microsoft Office Specialist: Word & Excel Proficiency Test',
                'description' => 'Test your core skills in Word formatting and Excel spreadsheet analysis.',
                'quiz_type' => 'practice',
                'class_level' => 'Professional',
                'duration_minutes' => 15,
                'total_marks' => 20,
                'pass_marks' => 10,
                'max_attempts' => 0,
                'is_published' => true,
            ]);

            self::addQuestion($quiz->id, 'In Microsoft Excel, what does the symbol "$" indicate in a cell reference like "$A$1"?', 5, 'The dollar sign creates an absolute reference that does not change when copied to other cells.', [
                ['text' => 'Absolute cell reference (locked row and column)', 'correct' => true],
                ['text' => 'Currency formatting for the cell', 'correct' => false],
                ['text' => 'Text string concatenation', 'correct' => false],
                ['text' => 'Division operator', 'correct' => false],
            ]);

            self::addQuestion($quiz->id, 'Which feature in Microsoft Word allows creating multiple personalized letters from a single template and data list?', 5, 'Mail Merge generates personalized documents using an address database.', [
                ['text' => 'Mail Merge', 'correct' => true],
                ['text' => 'Macros', 'correct' => false],
                ['text' => 'Track Changes', 'correct' => false],
                ['text' => 'Table of Authorities', 'correct' => false],
            ]);

            self::addQuestion($quiz->id, 'What is the default shortcut key in Microsoft Windows applications to Undo the last action?', 5, 'Ctrl + Z is the universal undo command.', [
                ['text' => 'Ctrl + Z', 'correct' => true],
                ['text' => 'Ctrl + Y', 'correct' => false],
                ['text' => 'Ctrl + U', 'correct' => false],
                ['text' => 'Ctrl + X', 'correct' => false],
            ]);

            self::addQuestion($quiz->id, 'Which Excel function counts only cells that meet a specified condition?', 5, 'COUNTIF counts cells in a range based on a given logical criterion.', [
                ['text' => 'COUNTIF', 'correct' => true],
                ['text' => 'COUNT', 'correct' => false],
                ['text' => 'COUNTA', 'correct' => false],
                ['text' => 'SUMIF', 'correct' => false],
            ]);
        }
    }

    protected static function seedArtificialIntelligenceQuiz($courseId)
    {
        if (LmsQuiz::where('course_id', $courseId)->count() === 0) {
            $quiz = LmsQuiz::create([
                'course_id' => $courseId,
                'title' => 'Artificial Intelligence & Prompt Engineering: Foundations Quiz',
                'description' => 'Test your understanding of generative models, tokens, context windows, and effective prompt structuring.',
                'quiz_type' => 'practice',
                'class_level' => 'Professional',
                'duration_minutes' => 15,
                'total_marks' => 20,
                'pass_marks' => 10,
                'max_attempts' => 0,
                'is_published' => true,
            ]);

            self::addQuestion($quiz->id, 'What is "Hallucination" in the context of Large Language Models (LLMs)?', 5, 'Hallucination occurs when an AI generates factually incorrect or fabricated claims with confidence.', [
                ['text' => 'When the model confidently generates plausible-sounding but factually incorrect information', 'correct' => true],
                ['text' => 'When the model crashes due to insufficient GPU memory', 'correct' => false],
                ['text' => 'When a prompt exceeds the token limit', 'correct' => false],
                ['text' => 'When the model switches languages unexpectedly', 'correct' => false],
            ]);

            self::addQuestion($quiz->id, 'In prompt engineering, what does "Few-Shot Prompting" refer to?', 5, 'Few-shot prompting provides a few explicit examples of desired input-output before the actual query.', [
                ['text' => 'Providing a few demonstration examples in the prompt before asking for the answer', 'correct' => true],
                ['text' => 'Asking the model to guess in fewer than 3 attempts', 'correct' => false],
                ['text' => 'Running multiple API calls simultaneously', 'correct' => false],
                ['text' => 'Using very short prompts under 10 words', 'correct' => false],
            ]);

            self::addQuestion($quiz->id, 'What is the role of "System Instructions / Persona" in prompt design?', 5, 'System prompts establish context, tone, boundaries, and role guidelines for subsequent replies.', [
                ['text' => 'Guiding the behavior, tone, constraints, and operational role of the AI model', 'correct' => true],
                ['text' => 'Encrypting the user data', 'correct' => false],
                ['text' => 'Accelerating the inference generation speed', 'correct' => false],
                ['text' => 'Deleting the chat history automatically', 'correct' => false],
            ]);

            self::addQuestion($quiz->id, 'Modern LLMs have an infinite context window and never forget prior chat contents. True or False?', 5, 'Models have finite context windows (e.g. 8k, 32k, 128k, 1M tokens) and lose context beyond their limit.', [
                ['text' => 'False', 'correct' => true],
                ['text' => 'True', 'correct' => false],
            ], 'true_false');
        }
    }

    protected static function addQuestion($quizId, $questionText, $marks, $explanation, array $options, $type = 'mcq_single')
    {
        $order = LmsQuestion::where('quiz_id', $quizId)->count() + 1;
        $question = LmsQuestion::create([
            'quiz_id' => $quizId,
            'question_text' => $questionText,
            'question_type' => $type,
            'marks' => $marks,
            'explanation' => $explanation,
            'order_index' => $order,
            'is_active' => true,
        ]);

        foreach ($options as $idx => $opt) {
            LmsQuestionOption::create([
                'question_id' => $question->id,
                'option_text' => $opt['text'],
                'is_correct' => $opt['correct'],
                'order_index' => $idx + 1,
            ]);
        }
    }
}
