<?php

namespace App\Services;

use App\model\Course;
use App\model\LmsChapter;
use App\model\LmsLesson;

class LmsCurriculumSeeder
{
    /**
     * Seed or sync real course chapters and lessons
     */
    public static function seedCurriculum()
    {
        // 1. Web Design & Development (ID 3 or slug matching)
        $webCourse = Course::where('id', 3)->orWhere('course_slug', 'LIKE', '%web-design%')->first();
        if ($webCourse && LmsChapter::where('course_id', $webCourse->id)->count() === 0) {
            self::seedWebDevelopment($webCourse->id);
        }

        // 2. Graphic Design (ID 1)
        $graphicsCourse = Course::where('id', 1)->orWhere('course_slug', 'LIKE', '%graphic%')->first();
        if ($graphicsCourse && LmsChapter::where('course_id', $graphicsCourse->id)->count() === 0) {
            self::seedGraphicDesign($graphicsCourse->id);
        }

        // 3. Microsoft Office Course (ID 10)
        $officeCourse = Course::where('id', 10)->orWhere('course_slug', 'LIKE', '%office%')->first();
        if ($officeCourse && LmsChapter::where('course_id', $officeCourse->id)->count() === 0) {
            self::seedMicrosoftOffice($officeCourse->id);
        }

        // 4. Digital Marketing (ID 2)
        $marketingCourse = Course::where('id', 2)->orWhere('course_slug', 'LIKE', '%digital-marketing%')->first();
        if ($marketingCourse && LmsChapter::where('course_id', $marketingCourse->id)->count() === 0) {
            self::seedDigitalMarketing($marketingCourse->id);
        }

        // 5. Ensure AI Course exists
        $aiCourse = Course::where('course_slug', 'artificial-intelligence-course-rajbari')->first();
        if (!$aiCourse) {
            $aiCourse = Course::create([
                'course_title' => 'Artificial Intelligence & Modern Tools (AI)',
                'course_slug' => 'artificial-intelligence-course-rajbari',
                'price' => '8000',
                'short_description' => 'Master practical AI tools, ChatGPT, Claude, Prompt Engineering, workflow automation and foundational machine learning.',
                'course_content' => 'AI Overview, Prompt Engineering, Generative AI for Graphic & Web, Automation Scripts, AI Ethics.',
                'long_description' => 'Complete hands-on masterclass in modern Artificial Intelligence tools and workflow integration.',
                'importents' => 'High demand skill for modern digital workflows.',
                'future_of_this_course' => 'Essential for software engineering, design and corporate automation.',
                'possibilities_of_this_course' => 'Freelancing, AI Automation Specialist, Prompt Engineer.',
                'student_quantity' => '25',
                'time_line' => '3 Months',
                'status' => 1,
                'image' => 'frontend/image/ai-course.jpg',
                'image_alt' => 'Wake Up ICT AI Course',
            ]);
        }
        if (LmsChapter::where('course_id', $aiCourse->id)->count() === 0) {
            self::seedArtificialIntelligence($aiCourse->id);
        }

        // 6. Ensure Academic ICT (Classes 6-10) Course exists
        $ictCourse = Course::where('course_slug', 'academic-ict-classes-6-10')->first();
        if (!$ictCourse) {
            $ictCourse = Course::create([
                'course_title' => 'Academic ICT (Classes 6–10 NCTB Curriculum)',
                'course_slug' => 'academic-ict-classes-6-10',
                'price' => '3500',
                'short_description' => 'Chapter-wise interactive ICT curriculum for Class 6, 7, 8, 9 & 10 students following the national NCTB textbook standards.',
                'course_content' => 'Chapter notes, Board exam MCQs, Computer architecture, Networking & Security, Spreadsheets & Database, Multimedia and Programming.',
                'long_description' => 'Structured academic course preparing secondary school students for ICT theory and practical board examinations.',
                'importents' => 'Aligned with secondary school national curriculum.',
                'future_of_this_course' => 'Building strong foundation for higher secondary and university ICT studies.',
                'possibilities_of_this_course' => 'Academic excellence in school exams and SSC board examination.',
                'student_quantity' => '40',
                'time_line' => 'Full Academic Session',
                'status' => 1,
                'image' => 'frontend/image/academic-ict.jpg',
                'image_alt' => 'Wake Up ICT Academic ICT Classes 6-10',
            ]);
        }
        if (LmsChapter::where('course_id', $ictCourse->id)->count() === 0) {
            self::seedAcademicIct($ictCourse->id);
        }
    }

    protected static function seedWebDevelopment($courseId)
    {
        $ch1 = LmsChapter::create([
            'course_id' => $courseId,
            'title' => 'Module 1: HTML5 Semantics & Web Foundations',
            'description' => 'Understanding web architecture, DOM structure, semantic HTML5, and forms.',
            'order_index' => 1,
            'status' => 1,
        ]);
        LmsLesson::create([
            'chapter_id' => $ch1->id,
            'course_id' => $courseId,
            'title' => '1.1 Introduction to Web & Client-Server Architecture',
            'lesson_type' => 'video',
            'video_provider' => 'youtube',
            'video_url' => 'https://www.youtube.com/watch?v=UB1O30fR-EE',
            'duration_minutes' => 25,
            'order_index' => 1,
            'is_free_preview' => true,
            'content' => 'Welcome to Web Development! In this lesson, we study how browsers communicate with web servers via HTTP/HTTPS protocols.',
        ]);
        LmsLesson::create([
            'chapter_id' => $ch1->id,
            'course_id' => $courseId,
            'title' => '1.2 HTML5 Semantic Elements & Modern Page Layouts',
            'lesson_type' => 'video',
            'video_provider' => 'youtube',
            'video_url' => 'https://www.youtube.com/watch?v=kUMe1FH4CHE',
            'duration_minutes' => 30,
            'order_index' => 2,
            'content' => 'Deep dive into header, nav, main, section, article, aside and footer tags.',
        ]);
        LmsLesson::create([
            'chapter_id' => $ch1->id,
            'course_id' => $courseId,
            'title' => '1.3 HTML5 Lecture Sheet & Cheatsheet (PDF)',
            'lesson_type' => 'pdf',
            'pdf_file' => 'public/uploads/materials/html5_complete_guide.pdf',
            'duration_minutes' => 15,
            'order_index' => 3,
            'content' => 'Downloadable reference guide with all essential HTML5 tags, attributes and form validations.',
        ]);

        $ch2 = LmsChapter::create([
            'course_id' => $courseId,
            'title' => 'Module 2: Modern CSS3, Flexbox & Responsive Design',
            'description' => 'Box model, CSS Grid, Flexbox, media queries and mobile-first design.',
            'order_index' => 2,
            'status' => 1,
        ]);
        LmsLesson::create([
            'chapter_id' => $ch2->id,
            'course_id' => $courseId,
            'title' => '2.1 CSS Box Model, Spacing & Typography',
            'lesson_type' => 'video',
            'video_provider' => 'youtube',
            'video_url' => 'https://www.youtube.com/watch?v=1PnVor36_40',
            'duration_minutes' => 35,
            'order_index' => 1,
            'content' => 'Understanding margins, padding, borders, box-sizing and Google Fonts integration.',
        ]);
        LmsLesson::create([
            'chapter_id' => $ch2->id,
            'course_id' => $courseId,
            'title' => '2.2 Flexbox & Grid Masterclass for Clean Layouts',
            'lesson_type' => 'video',
            'video_provider' => 'youtube',
            'video_url' => 'https://www.youtube.com/watch?v=fYq5PXgSsbE',
            'duration_minutes' => 45,
            'order_index' => 2,
            'content' => 'Build bulletproof responsive navigation bars, multi-column card grids and mobile layouts.',
        ]);
    }

    protected static function seedGraphicDesign($courseId)
    {
        $ch1 = LmsChapter::create([
            'course_id' => $courseId,
            'title' => 'Chapter 1: Principles of Visual Design & Color Theory',
            'description' => 'Color palettes, typography hierarchies, contrast and layout compositions.',
            'order_index' => 1,
            'status' => 1,
        ]);
        LmsLesson::create([
            'chapter_id' => $ch1->id,
            'course_id' => $courseId,
            'title' => '1.1 Color Theory: RGB, CMYK & Harmonious Palettes',
            'lesson_type' => 'video',
            'video_provider' => 'youtube',
            'video_url' => 'https://www.youtube.com/watch?v=_2LLXnUdUIc',
            'duration_minutes' => 20,
            'order_index' => 1,
            'is_free_preview' => true,
            'content' => 'Learn how to choose color harmonies, psychology of brand colors and contrast ratios.',
        ]);
        LmsLesson::create([
            'chapter_id' => $ch1->id,
            'course_id' => $courseId,
            'title' => '1.2 Graphic Designer Handout & Color Wheel (PDF)',
            'lesson_type' => 'pdf',
            'pdf_file' => 'public/uploads/materials/graphic_design_handbook.pdf',
            'duration_minutes' => 10,
            'order_index' => 2,
            'content' => 'Downloadable reference chart covering color schemes, resolution standards (72 vs 300 DPI), and bleeds.',
        ]);

        $ch2 = LmsChapter::create([
            'course_id' => $courseId,
            'title' => 'Chapter 2: Adobe Photoshop Core Tools',
            'description' => 'Selections, layers, masking, photo retouching, and banner compositions.',
            'order_index' => 2,
            'status' => 1,
        ]);
        LmsLesson::create([
            'chapter_id' => $ch2->id,
            'course_id' => $courseId,
            'title' => '2.1 Layer Masks & Non-Destructive Editing',
            'lesson_type' => 'video',
            'video_provider' => 'youtube',
            'video_url' => 'https://www.youtube.com/watch?v=IyR_uYsRdPs',
            'duration_minutes' => 30,
            'order_index' => 1,
            'content' => 'Master clipping masks, layer adjustments, and non-destructive image blending.',
        ]);
    }

    protected static function seedMicrosoftOffice($courseId)
    {
        $ch1 = LmsChapter::create([
            'course_id' => $courseId,
            'title' => 'Module 1: Microsoft Word — Professional Document Formatting',
            'description' => 'Document structure, headers/footers, tables, mail merge, and official letters.',
            'order_index' => 1,
            'status' => 1,
        ]);
        LmsLesson::create([
            'chapter_id' => $ch1->id,
            'course_id' => $courseId,
            'title' => '1.1 MS Word Interface, Page Setup & Typography',
            'lesson_type' => 'video',
            'video_provider' => 'youtube',
            'video_url' => 'https://www.youtube.com/watch?v=fUkh3RwkHUM',
            'duration_minutes' => 25,
            'order_index' => 1,
            'is_free_preview' => true,
            'content' => 'Learn page margins, orientation, paper sizes, paragraph alignments and styles in Word.',
        ]);
        LmsLesson::create([
            'chapter_id' => $ch1->id,
            'course_id' => $courseId,
            'title' => '1.2 Official Letter & Report Templates (PDF)',
            'lesson_type' => 'pdf',
            'pdf_file' => 'public/uploads/materials/ms_word_practical_guide.pdf',
            'duration_minutes' => 15,
            'order_index' => 2,
            'content' => 'Downloadable templates for official memo, government letter format and resume.',
        ]);

        $ch2 = LmsChapter::create([
            'course_id' => $courseId,
            'title' => 'Module 2: Microsoft Excel — Formulas, Functions & Data Analysis',
            'description' => 'Spreadsheets, mathematical formulas (SUM, AVERAGE, IF, VLOOKUP), and financial charts.',
            'order_index' => 2,
            'status' => 1,
        ]);
        LmsLesson::create([
            'chapter_id' => $ch2->id,
            'course_id' => $courseId,
            'title' => '2.1 Essential Excel Formulas: SUM, AVERAGE, COUNT, IF',
            'lesson_type' => 'video',
            'video_provider' => 'youtube',
            'video_url' => 'https://www.youtube.com/watch?v=k1VUZEVuDJ8',
            'duration_minutes' => 40,
            'order_index' => 1,
            'content' => 'Formula syntax, cell referencing (relative vs absolute $A$1), and conditional logic.',
        ]);
    }

    protected static function seedDigitalMarketing($courseId)
    {
        $ch1 = LmsChapter::create([
            'course_id' => $courseId,
            'title' => 'Chapter 1: Search Engine Optimization (SEO) Fundamentals',
            'description' => 'On-page SEO, keyword research, meta tags, and Google ranking factors.',
            'order_index' => 1,
            'status' => 1,
        ]);
        LmsLesson::create([
            'chapter_id' => $ch1->id,
            'course_id' => $courseId,
            'title' => '1.1 How Search Engines Work & Keyword Intent',
            'lesson_type' => 'video',
            'video_provider' => 'youtube',
            'video_url' => 'https://www.youtube.com/watch?v=xsVTqzratPs',
            'duration_minutes' => 30,
            'order_index' => 1,
            'is_free_preview' => true,
            'content' => 'Crawling, indexing, search algorithms and finding high-volume, low-competition keywords.',
        ]);
    }

    protected static function seedArtificialIntelligence($courseId)
    {
        $ch1 = LmsChapter::create([
            'course_id' => $courseId,
            'title' => 'Module 1: Generative AI & Prompt Engineering Masterclass',
            'description' => 'Master prompting techniques (zero-shot, few-shot, role-based) with modern LLMs.',
            'order_index' => 1,
            'status' => 1,
        ]);
        LmsLesson::create([
            'chapter_id' => $ch1->id,
            'course_id' => $courseId,
            'title' => '1.1 Foundations of Generative AI & Large Language Models',
            'lesson_type' => 'video',
            'video_provider' => 'youtube',
            'video_url' => 'https://www.youtube.com/watch?v=2eWuYf-aZE4',
            'duration_minutes' => 30,
            'order_index' => 1,
            'is_free_preview' => true,
            'content' => 'Learn how transformer models work, tokens, temperature, context windows and practical everyday use.',
        ]);
        LmsLesson::create([
            'chapter_id' => $ch1->id,
            'course_id' => $courseId,
            'title' => '1.2 Prompt Engineering Cheat Sheet & Templates (PDF)',
            'lesson_type' => 'pdf',
            'pdf_file' => 'public/uploads/materials/ai_prompt_engineering_guide.pdf',
            'duration_minutes' => 15,
            'order_index' => 2,
            'content' => 'Curated collection of 50+ high-performing prompt templates for coding, content creation and marketing.',
        ]);
    }

    protected static function seedAcademicIct($courseId)
    {
        $ch1 = LmsChapter::create([
            'course_id' => $courseId,
            'title' => 'Class 6 & 7 ICT: তথ্য ও যোগাযোগ প্রযুক্তি পরিচিতি',
            'description' => 'কম্পিউটার হার্ডওয়্যার, সফটওয়্যার, নেটওয়ার্ক এবং দৈনন্দিন জীবনে আইসিটির নিরাপদ ব্যবহার।',
            'order_index' => 1,
            'status' => 1,
        ]);
        LmsLesson::create([
            'chapter_id' => $ch1->id,
            'course_id' => $courseId,
            'title' => 'অধ্যায় ১: তথ্য ও যোগাযোগ প্রযুক্তি এবং আমাদের সমাজ',
            'lesson_type' => 'video',
            'video_provider' => 'youtube',
            'video_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'duration_minutes' => 25,
            'order_index' => 1,
            'is_free_preview' => true,
            'content' => 'তথ্য ও যোগাযোগ প্রযুক্তির প্রাথমিক ধারণা, ইনপুট-আউটপুট ডিভাইস, স্টোরেজ ডিভাইস ও মেমরি।',
        ]);
        LmsLesson::create([
            'chapter_id' => $ch1->id,
            'course_id' => $courseId,
            'title' => 'শ্রেণী ৬-৭ আইসিটি অধ্যায়ভিত্তিক লেকচার শীট (PDF)',
            'lesson_type' => 'pdf',
            'pdf_file' => 'public/uploads/materials/class_6_7_ict_notes.pdf',
            'duration_minutes' => 20,
            'order_index' => 2,
            'content' => 'বোর্ড বইয়ের গুরুত্বপূর্ণ সংক্ষিপ্ত প্রশ্নোত্তর ও নৈর্ব্যক্তিক (MCQ) সংগ্রহ।',
        ]);

        $ch2 = LmsChapter::create([
            'course_id' => $courseId,
            'title' => 'Class 8, 9 ও 10 ICT: নেটওয়ার্ক, স্প্রেডশিট ও প্রোগ্রামিং ধারণা',
            'description' => 'টপোলজি, ক্লাউড কম্পিউটিং, সাইবার নিরাপত্তা, স্প্রেডশিটের হিসাব ও প্রোগ্রামিংয়ের ভাষা।',
            'order_index' => 2,
            'status' => 1,
        ]);
        LmsLesson::create([
            'chapter_id' => $ch2->id,
            'course_id' => $courseId,
            'title' => 'অধ্যায় ২: কম্পিউটার নেটওয়ার্ক ও টপোলজি (বাস, রিং, স্টার, মেশ, ট্রি)',
            'lesson_type' => 'video',
            'video_provider' => 'youtube',
            'video_url' => 'https://www.youtube.com/watch?v=0bA_M48qf_s',
            'duration_minutes' => 35,
            'order_index' => 1,
            'content' => 'বিভিন্ন নেটওয়ার্ক টপোলজি, হাব, সুইচ, রাউটার ও ইন্টারনেটের কার্যপদ্ধতি।',
        ]);
        LmsLesson::create([
            'chapter_id' => $ch2->id,
            'course_id' => $courseId,
            'title' => 'এসএসসি আইসিটি বোর্ড প্রশ্ন ও সমাধান হ্যান্ডআউট (PDF)',
            'lesson_type' => 'pdf',
            'pdf_file' => 'public/uploads/materials/ssc_ict_board_questions.pdf',
            'duration_minutes' => 30,
            'order_index' => 2,
            'content' => 'গত ৫ বছরের সকল শিক্ষা বোর্ডের গুরুত্বপূর্ণ প্রশ্নের ব্যাখ্যাসহ সমাধান।',
        ]);
    }
}
