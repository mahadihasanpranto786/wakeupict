<?php

namespace App\Services;

use App\model\LmsQuiz;
use App\model\LmsQuestion;
use App\model\LmsQuestionOption;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Exception;

class QuizExcelImportService
{
    /**
     * Import MCQ Questions and Options from Excel/CSV file
     *
     * @param string $filePath Absolute path to the uploaded file
     * @param int $quizId
     * @return array [ 'success' => bool, 'imported_count' => int, 'errors' => array ]
     */
    public function importFromFile($filePath, $quizId = null, $courseId = null, array $defaults = [])
    {
        $quiz = $quizId ? LmsQuiz::find($quizId) : null;
        if ($quiz && !$courseId) {
            $courseId = $quiz->course_id;
        }

        try {
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, true);
        } catch (Exception $e) {
            return [
                'success' => false,
                'imported_count' => 0,
                'errors' => ['Failed to parse spreadsheet: ' . $e->getMessage()],
            ];
        }

        if (empty($rows)) {
            return [
                'success' => false,
                'imported_count' => 0,
                'errors' => ['The uploaded Excel file appears to be empty.'],
            ];
        }

        // 1. Identify header columns
        $headerRow = null;
        $headerIndex = null;

        foreach ($rows as $rowIndex => $row) {
            $nonEmpty = array_filter($row);
            if (!empty($nonEmpty)) {
                $headerRow = $row;
                $headerIndex = $rowIndex;
                break;
            }
        }

        if (!$headerRow) {
            return [
                'success' => false,
                'imported_count' => 0,
                'errors' => ['Could not detect header row in Excel.'],
            ];
        }

        $colMap = $this->mapColumns($headerRow);

        if (!isset($colMap['question'])) {
            return [
                'success' => false,
                'imported_count' => 0,
                'errors' => ['Header column for "Question" / "question_text" is missing.'],
            ];
        }

        $importedCount = 0;
        $errors = [];

        if ($quiz) {
            $currentOrder = LmsQuestion::where('quiz_id', $quiz->id)->max('order_index') ?: 0;
            $existingQuestions = LmsQuestion::where('quiz_id', $quiz->id)->pluck('question_text')->map(function($t) {
                return strtolower(trim(preg_replace('/\s+/', ' ', $t)));
            })->toArray();
        } elseif ($courseId) {
            $currentOrder = LmsQuestion::where('course_id', $courseId)->max('order_index') ?: 0;
            $existingQuestions = LmsQuestion::where('course_id', $courseId)->pluck('question_text')->map(function($t) {
                return strtolower(trim(preg_replace('/\s+/', ' ', $t)));
            })->toArray();
        } else {
            $currentOrder = LmsQuestion::max('order_index') ?: 0;
            $existingQuestions = LmsQuestion::latest('id')->take(500)->pluck('question_text')->map(function($t) {
                return strtolower(trim(preg_replace('/\s+/', ' ', $t)));
            })->toArray();
        }

        DB::beginTransaction();

        try {
            foreach ($rows as $rowIndex => $row) {
                // Skip rows at or before header
                if ($rowIndex <= $headerIndex) {
                    continue;
                }

                $qText = isset($colMap['question'], $row[$colMap['question']]) ? trim((string)$row[$colMap['question']]) : '';
                if ($qText === '') {
                    continue; // Skip blank rows
                }

                $normalizedQ = strtolower(trim(preg_replace('/\s+/', ' ', $qText)));
                if (in_array($normalizedQ, $existingQuestions)) {
                    $errors[] = "Row {$rowIndex}: Duplicate question detected and skipped ('" . mb_substr($qText, 0, 45) . "...').";
                    continue;
                }

                $optA = isset($colMap['option_a'], $row[$colMap['option_a']]) ? trim((string)$row[$colMap['option_a']]) : '';
                $optB = isset($colMap['option_b'], $row[$colMap['option_b']]) ? trim((string)$row[$colMap['option_b']]) : '';
                $optC = isset($colMap['option_c'], $row[$colMap['option_c']]) ? trim((string)$row[$colMap['option_c']]) : '';
                $optD = isset($colMap['option_d'], $row[$colMap['option_d']]) ? trim((string)$row[$colMap['option_d']]) : '';

                if ($optA === '' || $optB === '') {
                    $errors[] = "Row {$rowIndex}: At least Option A and Option B must be provided for question '{$qText}'.";
                    continue;
                }

                $rawCorrect = isset($colMap['correct'], $row[$colMap['correct']]) ? trim((string)$row[$colMap['correct']]) : 'A';
                $marks = isset($colMap['marks'], $row[$colMap['marks']]) && is_numeric($row[$colMap['marks']]) ? (float)$row[$colMap['marks']] : 1.0;
                $negMarks = isset($colMap['negative_marks'], $row[$colMap['negative_marks']]) && is_numeric($row[$colMap['negative_marks']]) ? abs((float)$row[$colMap['negative_marks']]) : null;
                $explanation = isset($colMap['explanation'], $row[$colMap['explanation']]) ? trim((string)$row[$colMap['explanation']]) : null;
                $setCode = isset($colMap['set_code'], $row[$colMap['set_code']]) && trim((string)$row[$colMap['set_code']]) !== '' ? trim((string)$row[$colMap['set_code']]) : ($quiz ? ($quiz->question_set ?: 'Set A') : ($defaults['set_code'] ?? 'Set A'));
                $category = isset($colMap['category'], $row[$colMap['category']]) && trim((string)$row[$colMap['category']]) !== '' ? trim((string)$row[$colMap['category']]) : ($defaults['category'] ?? null);
                $chapter = isset($colMap['chapter'], $row[$colMap['chapter']]) && trim((string)$row[$colMap['chapter']]) !== '' ? trim((string)$row[$colMap['chapter']]) : ($defaults['chapter'] ?? null);
                $topic = isset($colMap['topic'], $row[$colMap['topic']]) && trim((string)$row[$colMap['topic']]) !== '' ? trim((string)$row[$colMap['topic']]) : ($defaults['topic'] ?? null);
                $difficulty = isset($colMap['difficulty'], $row[$colMap['difficulty']]) ? strtolower(trim((string)$row[$colMap['difficulty']])) : 'medium';
                if (!in_array($difficulty, ['easy', 'medium', 'hard'])) {
                    $difficulty = 'medium';
                }
                $stimulus = isset($colMap['stimulus'], $row[$colMap['stimulus']]) ? trim((string)$row[$colMap['stimulus']]) : null;

                $currentOrder++;

                // Create Question
                $question = LmsQuestion::create([
                    'quiz_id'        => $quiz ? $quiz->id : null,
                    'course_id'      => $courseId,
                    'question_text'  => $qText,
                    'question_type'  => 'mcq_single',
                    'marks'          => $marks > 0 ? $marks : 1.0,
                    'negative_marks' => $negMarks,
                    'set_code'       => $setCode,
                    'category'       => $category,
                    'chapter'        => $chapter,
                    'topic'          => $topic,
                    'difficulty'     => $difficulty,
                    'stimulus'       => $stimulus,
                    'explanation'    => $explanation ?: null,
                    'order_index'    => $currentOrder,
                    'is_active'      => true,
                ]);

                $existingQuestions[] = $normalizedQ;

                // Determine correct option
                $correctIndex = $this->resolveCorrectOption($rawCorrect, [$optA, $optB, $optC, $optD]);

                $optionsData = [
                    ['text' => $optA, 'is_correct' => ($correctIndex === 0), 'order' => 1],
                    ['text' => $optB, 'is_correct' => ($correctIndex === 1), 'order' => 2],
                ];

                if ($optC !== '') {
                    $optionsData[] = ['text' => $optC, 'is_correct' => ($correctIndex === 2), 'order' => 3];
                }
                if ($optD !== '') {
                    $optionsData[] = ['text' => $optD, 'is_correct' => ($correctIndex === 3), 'order' => 4];
                }

                foreach ($optionsData as $od) {
                    LmsQuestionOption::create([
                        'question_id' => $question->id,
                        'option_text' => $od['text'],
                        'is_correct'  => $od['is_correct'],
                        'order_index' => $od['order'],
                    ]);
                }

                $importedCount++;
            }

            // Update Quiz total marks
            $totalQuizMarks = 0;
            if ($quiz) {
                $totalQuizMarks = LmsQuestion::where('quiz_id', $quiz->id)->sum('marks');
                $quiz->update(['total_marks' => $totalQuizMarks]);
            }

            DB::commit();

            return [
                'success' => true,
                'imported_count' => $importedCount,
                'errors' => $errors,
                'total_marks' => $totalQuizMarks,
            ];

        } catch (Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'imported_count' => 0,
                'errors' => ['Transaction error: ' . $e->getMessage()],
            ];
        }
    }

    /**
     * Map Excel column letters to semantic field keys
     */
    protected function mapColumns(array $headerRow)
    {
        $map = [];

        foreach ($headerRow as $colLetter => $rawHeader) {
            $h = strtolower(trim((string)$rawHeader));
            $h = str_replace(['_', '-', ' ', '.'], '', $h);

            // Question
            if (in_array($h, ['question', 'questiontext', 'qtext', 'প্রশ্ন', 'mcq', 'problem'])) {
                $map['question'] = $colLetter;
            }
            // Option A
            elseif (in_array($h, ['optiona', 'option1', 'opt1', 'opta', 'ক', 'a'])) {
                $map['option_a'] = $colLetter;
            }
            // Option B
            elseif (in_array($h, ['optionb', 'option2', 'opt2', 'optb', 'খ', 'b'])) {
                $map['option_b'] = $colLetter;
            }
            // Option C
            elseif (in_array($h, ['optionc', 'option3', 'opt3', 'optc', 'গ', 'c'])) {
                $map['option_c'] = $colLetter;
            }
            // Option D
            elseif (in_array($h, ['optiond', 'option4', 'opt4', 'optd', 'ঘ', 'd'])) {
                $map['option_d'] = $colLetter;
            }
            // Correct answer
            elseif (in_array($h, ['correct', 'correctanswer', 'correctoption', 'answer', 'ans', 'সঠিকউত্তর', 'সঠিক'])) {
                $map['correct'] = $colLetter;
            }
            // Marks
            elseif (in_array($h, ['marks', 'mark', 'points', 'point', 'score', 'নম্বর'])) {
                $map['marks'] = $colLetter;
            }
            // Negative Marks
            elseif (in_array($h, ['negativemarks', 'negativemark', 'negative', 'negmarks', 'ভুলনম্বর', 'নেগেটিভমার্ক', 'ভুলকাটা'])) {
                $map['negative_marks'] = $colLetter;
            }
            // Set Code (Set A, Set B, Set C, Set D)
            elseif (in_array($h, ['set', 'setcode', 'সেট', 'questiongroup', 'group'])) {
                $map['set_code'] = $colLetter;
            }
            // Category / Subject
            elseif (in_array($h, ['category', 'ক্যাটাগরি', 'ক্যাটেগরি', 'subject', 'বিষয়', 'বিষয়'])) {
                $map['category'] = $colLetter;
            }
            // Chapter
            elseif (in_array($h, ['chapter', 'অধ্যায়', 'অধ্যায়', 'পাঠ'])) {
                $map['chapter'] = $colLetter;
            }
            // Topic
            elseif (in_array($h, ['topic', 'টপিক', 'বিষয়বস্তু'])) {
                $map['topic'] = $colLetter;
            }
            // Difficulty
            elseif (in_array($h, ['difficulty', 'level', 'লেভেল', 'কঠিন্যতা'])) {
                $map['difficulty'] = $colLetter;
            }
            // Stimulus / Passage
            elseif (in_array($h, ['stimulus', 'passage', 'context', 'উদ্দীপক'])) {
                $map['stimulus'] = $colLetter;
            }
            // Explanation
            elseif (in_array($h, ['explanation', 'explain', 'solution', 'ব্যাখ্যা'])) {
                $map['explanation'] = $colLetter;
            }
        }

        return $map;
    }

    /**
     * Resolve correct option (0=A, 1=B, 2=C, 3=D)
     */
    protected function resolveCorrectOption($rawCorrect, array $options)
    {
        $val = strtoupper(trim((string)$rawCorrect));

        if (in_array($val, ['A', '1', 'ক', 'FIRST', 'OPT A', 'OPTION A'])) {
            return 0;
        }
        if (in_array($val, ['B', '2', 'খ', 'SECOND', 'OPT B', 'OPTION B'])) {
            return 1;
        }
        if (in_array($val, ['C', '3', 'গ', 'THIRD', 'OPT C', 'OPTION C'])) {
            return 2;
        }
        if (in_array($val, ['D', '4', 'ঘ', 'FOURTH', 'OPT D', 'OPTION D'])) {
            return 3;
        }

        // Direct text match
        foreach ($options as $idx => $optText) {
            if ($optText !== '' && strcasecmp(trim($optText), trim((string)$rawCorrect)) === 0) {
                return $idx;
            }
        }

        return 0; // Default to Option A
    }

    /**
     * Generate sample CSV template with UTF-8 BOM
     */
    public function generateSampleCsv()
    {
        $headers = [
            'question_text',
            'option_a',
            'option_b',
            'option_c',
            'option_d',
            'correct_option',
            'marks',
            'negative_marks',
            'set_code',
            'category',
            'chapter',
            'topic',
            'difficulty',
            'stimulus',
            'explanation'
        ];

        $sampleRows = [
            [
                'Which of the following is considered an Input Device in computer architecture?',
                'Keyboard',
                'Monitor',
                'Speaker',
                'Laser Printer',
                'A',
                '1',
                '0.25',
                'Set A',
                'Computer Basics',
                'Hardware Fundamentals',
                'Input Devices',
                'easy',
                '',
                'Keyboard feeds data and keystrokes into the central processing unit.'
            ],
            [
                'কম্পিউটারের কেন্দ্রীয় প্রক্রিয়াকরণ ইউনিট (CPU) এর মূল অংশ কয়টি?',
                '২টি',
                '৩টি (ALU, CU, Registers)',
                '৪টি',
                '৫টি',
                'B',
                '1',
                '0.25',
                'Set A',
                'ICT Academic',
                'Computer Structure',
                'CPU Architecture',
                'medium',
                '',
                'CPU প্রধানত তিনটি অংশে বিভক্ত: ALU, Control Unit এবং Registers/Memory Unit.'
            ],
            [
                'উদ্দীপকের আলোকে নিচের কোনটি সত্য?',
                'i ও ii',
                'i ও iii',
                'ii ও iii',
                'i, ii ও iii',
                'D',
                '1',
                '0.50',
                'Set B',
                'Bangla Sahitya',
                'গদ্য',
                'উপন্যাস বিশ্লেষণ',
                'hard',
                'জালালের দুই বউয়ের মধ্যে মিমি ছোট। সে সংসার সম্পর্কে উদাসীন।',
                'উদ্দীপকে মিমির স্বাধীনচেতা ও চঞ্চল মনোভাব সবকটি বৈশিষ্ট্যকে সমর্থন করে।'
            ],
            [
                'HTML ভাষায় সবচেয়ে বড় শিরোনাম (Largest Heading) প্রদর্শনের ট্যাগ কোনটি?',
                '<h6>',
                '<head>',
                '<h1>',
                '<header>',
                'C',
                '1',
                '0.25',
                'Set B',
                'Web Development',
                'HTML5 Basics',
                'Semantic Headers',
                'easy',
                '',
                '<h1> ট্যাগটি HTML স্ট্যান্ডার্ড অনুসারে প্রধান শিরোনামের জন্য নির্ধারিত।'
            ],
            [
                'Microsoft Excel এ যোগফল নির্ণয়ের জন্য কোন ফর্মুলাটি ব্যবহৃত হয়?',
                '=TOTAL(A1:A10)',
                '=ADD(A1:A10)',
                '=COUNT(A1:A10)',
                '=SUM(A1:A10)',
                'D',
                '1',
                '0.25',
                'Set A',
                'Office Applications',
                'Spreadsheet Analysis',
                'Mathematical Formulas',
                'easy',
                '',
                '=SUM() ফাংশন নির্বাচিত সেল রেঞ্জের মোট যোগফল বের করে।'
            ]
        ];

        $output = "\xEF\xBB\xBF"; // UTF-8 BOM for Microsoft Excel
        $f = fopen('php://memory', 'r+');
        fputcsv($f, $headers);
        foreach ($sampleRows as $row) {
            fputcsv($f, $row);
        }
        rewind($f);
        $output .= stream_get_contents($f);
        fclose($f);

        return $output;
    }
}
