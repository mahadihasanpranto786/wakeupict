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
    public function importFromFile($filePath, $quizId)
    {
        $quiz = LmsQuiz::findOrFail($quizId);

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
        $currentOrder = LmsQuestion::where('quiz_id', $quizId)->max('order_index') ?: 0;

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
                $explanation = isset($colMap['explanation'], $row[$colMap['explanation']]) ? trim((string)$row[$colMap['explanation']]) : null;

                $currentOrder++;

                // Create Question
                $question = LmsQuestion::create([
                    'quiz_id'       => $quizId,
                    'question_text' => $qText,
                    'question_type' => 'mcq',
                    'marks'         => $marks > 0 ? $marks : 1.0,
                    'explanation'   => $explanation ?: null,
                    'order_index'   => $currentOrder,
                    'is_active'     => true,
                ]);

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
            $totalQuizMarks = LmsQuestion::where('quiz_id', $quizId)->sum('marks');
            $quiz->update(['total_marks' => $totalQuizMarks]);

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
        $headers = ['question_text', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_option', 'marks', 'explanation'];

        $sampleRows = [
            [
                'Which of the following is considered an Input Device in computer architecture?',
                'Keyboard',
                'Monitor',
                'Speaker',
                'Laser Printer',
                'A',
                '1',
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
                'CPU প্রধানত তিনটি অংশে বিভক্ত: ALU, Control Unit এবং Registers/Memory Unit.'
            ],
            [
                'HTML ভাষায় সবচেয়ে বড় শিরোনাম (Largest Heading) প্রদর্শনের ট্যাগ কোনটি?',
                '<h6>',
                '<head>',
                '<h1>',
                '<header>',
                'C',
                '1',
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
                '=SUM() ফাংশন নির্বাচিত সেল রেঞ্জের মোট যোগফল বের করে।'
            ],
            [
                'Graphic Design এ RGB কালার মোড প্রধানত কিসের জন্য ব্যবহৃত হয়?',
                'ডিজিটাল স্ক্রিন ও ওয়েব ডিসপ্লে',
                'অফসেট প্রিন্টিং',
                'বিলবোর্ড ভিনাইল প্রিন্ট',
                'লেজার কাটিং',
                'A',
                '1',
                'RGB (Red Green Blue) কালার মোড স্ক্রিন ও ডিজিটাল মিডিয়ার জন্য আদর্শ।'
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
