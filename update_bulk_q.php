<?php
$ctrlFile = 'app/Http/Controllers/backend/theme/clasic/lms/AdminQuizController.php';
$ctrl = file_get_contents($ctrlFile);
$eol = strpos($ctrl, "\r\n") !== false ? "\r\n" : "\n";

$targetStr = 'public function destroy($id)';
$bulkMethod = <<<PHP
    /**
     * Bulk delete multiple questions from a Quiz
     */
    public function bulkDeleteQuestions(Request \$request, \$quizId)
    {
        \$quiz = LmsQuiz::findOrFail(\$quizId);

        \$request->validate([
            'question_ids' => 'required|array|min:1',
            'question_ids.*' => 'integer|exists:lms_questions,id',
        ]);

        \$ids = \$request->input('question_ids', []);
        \$count = count(\$ids);

        DB::transaction(function () use (\$quiz, \$ids) {
            \\App\\model\\LmsQuestionOption::whereIn('question_id', \$ids)->delete();
            \\App\\model\\LmsQuizAnswer::whereIn('question_id', \$ids)->delete();
            LmsQuestion::where('quiz_id', \$quiz->id)->whereIn('id', \$ids)->delete();

            // Recalculate marks
            \$totalMarks = LmsQuestion::where('quiz_id', \$quiz->id)->sum('marks');
            \$quiz->update(['total_marks' => \$totalMarks]);
        });

        return redirect()->back()->with('success', "নির্বাচিত {\$count}টি প্রশ্ন কুইজ থেকে সফলভাবে মুছে ফেলা হয়েছে!");
    }

PHP;
$bulkMethod = str_replace("\n", $eol, $bulkMethod);

if (strpos($ctrl, 'function bulkDeleteQuestions') === false) {
    $ctrl = str_replace($targetStr, $bulkMethod . '    ' . $targetStr, $ctrl);
    file_put_contents($ctrlFile, $ctrl);
    echo "bulkDeleteQuestions added to AdminQuizController.php\n";
} else {
    echo "bulkDeleteQuestions already in AdminQuizController.php\n";
}

// 3. Update questions.blade.php
$qViewFile = 'resources/views/backend/theme/clasic/lms/quizzes/questions.blade.php';
$qContent = file_get_contents($qViewFile);
$eolView = strpos($qContent, "\r\n") !== false ? "\r\n" : "\n";

// Wrap table with form and add Bulk Action Bar and checkbox column
$searchCardStart = '<div class="card shadow-sm border-0">' . $eolView .
'        <div class="card-body p-0 table-responsive">' . $eolView .
'            <table class="table table-hover align-middle mb-0">' . $eolView .
'                <thead class="bg-light text-uppercase text-xs font-weight-bold text-muted">' . $eolView .
'                    <tr>' . $eolView .
'                        <th class="text-center" style="width: 50px;">#</th>';

$replaceCardStart = '<div class="card shadow-sm border-0">' . $eolView .
'        <!-- Bulk Action Bar -->' . $eolView .
'        <div id="bulkActionBar" class="card-header bg-light border-bottom py-2" style="display: none;">' . $eolView .
'            <div class="d-flex align-items-center justify-content-between flex-wrap">' . $eolView .
'                <div class="d-flex align-items-center my-1">' . $eolView .
'                    <span class="badge badge-primary px-2.5 py-1 text-sm font-weight-bold mr-2">' . $eolView .
'                        <i class="fas fa-check-square mr-1"></i> <span id="selectedCountText">০</span> টি প্রশ্ন নির্বাচিত' . $eolView .
'                    </span>' . $eolView .
'                    <span class="text-xs text-muted">একসাথে একাধিক প্রশ্ন কুইজ থেকে মুছে ফেলতে পাশের বাটনে ক্লিক করুন।</span>' . $eolView .
'                </div>' . $eolView .
'                <div class="my-1">' . $eolView .
'                    <button type="button" class="btn btn-sm btn-danger font-weight-bold shadow-sm" onclick="executeBulkDeleteQuestions()">' . $eolView .
'                        <i class="fas fa-trash-alt mr-1"></i> নির্বাচিত প্রশ্নসমূহ মুছুন (Bulk Delete)' . $eolView .
'                    </button>' . $eolView .
'                    <button type="button" class="btn btn-sm btn-outline-secondary ml-1" onclick="clearAllQuestionSelections()">' . $eolView .
'                        বাতিল' . $eolView .
'                    </button>' . $eolView .
'                </div>' . $eolView .
'            </div>' . $eolView .
'        </div>' . $eolView .
$eolView .
'        <form id="bulkDeleteQuestionsForm" action="{{ route(\'admin.quizzes.questions.bulk-delete\', $quiz->id) }}" method="POST">' . $eolView .
'        @csrf' . $eolView .
'        <div class="card-body p-0 table-responsive">' . $eolView .
'            <table class="table table-hover align-middle mb-0">' . $eolView .
'                <thead class="bg-light text-uppercase text-xs font-weight-bold text-muted">' . $eolView .
'                    <tr>' . $eolView .
'                        <th class="text-center" style="width: 40px;">' . $eolView .
'                            <input type="checkbox" id="selectAllCheckbox" style="cursor: pointer; transform: scale(1.15);" title="সবগুলো প্রশ্ন একসাথে নির্বাচন করুন">' . $eolView .
'                        </th>' . $eolView .
'                        <th class="text-center" style="width: 50px;">#</th>';

if (strpos($qContent, $searchCardStart) !== false) {
    $qContent = str_replace($searchCardStart, $replaceCardStart, $qContent);
}

// Add checkbox to each row
$searchRowStart = '<tr>' . $eolView .
'                            <td class="text-center text-muted font-weight-bold">' . $eolView .
'                                {{ $loop->iteration + ($questions->currentPage() - 1) * $questions->perPage() }}' . $eolView .
'                            </td>';

$replaceRowStart = '<tr>' . $eolView .
'                            <td class="text-center">' . $eolView .
'                                <input type="checkbox" name="question_ids[]" value="{{ $q->id }}" class="question-checkbox" style="cursor: pointer; transform: scale(1.15);">' . $eolView .
'                            </td>' . $eolView .
'                            <td class="text-center text-muted font-weight-bold">' . $eolView .
'                                {{ $loop->iteration + ($questions->currentPage() - 1) * $questions->perPage() }}' . $eolView .
'                            </td>';

if (strpos($qContent, $searchRowStart) !== false) {
    $qContent = str_replace($searchRowStart, $replaceRowStart, $qContent);
}

// Change empty colspan from 6 to 7
$qContent = str_replace('<td colspan="6"', '<td colspan="7"', $qContent);

// Close bulk form
$searchTableEnd = '</table>' . $eolView . '        </div>';
$replaceTableEnd = '</table>' . $eolView . '        </div>' . $eolView . '        </form>';
if (strpos($qContent, $searchTableEnd) !== false) {
    $qContent = str_replace($searchTableEnd, $replaceTableEnd, $qContent);
}

// Add JS at bottom
$scriptCode = <<<HTML

    <script>
        function updateBulkQuestionBar() {
            var checkboxes = document.querySelectorAll('.question-checkbox:checked');
            var count = checkboxes.length;
            var bar = document.getElementById('bulkActionBar');
            var countText = document.getElementById('selectedCountText');
            var selectAll = document.getElementById('selectAllCheckbox');

            if (countText) countText.innerText = count;
            if (bar) {
                bar.style.display = count > 0 ? 'block' : 'none';
            }

            var allBoxes = document.querySelectorAll('.question-checkbox');
            if (selectAll && allBoxes.length > 0) {
                selectAll.checked = (checkboxes.length === allBoxes.length);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var selectAll = document.getElementById('selectAllCheckbox');
            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    var checked = this.checked;
                    document.querySelectorAll('.question-checkbox').forEach(function(cb) {
                        cb.checked = checked;
                    });
                    updateBulkQuestionBar();
                });
            }

            document.querySelectorAll('.question-checkbox').forEach(function(cb) {
                cb.addEventListener('change', updateBulkQuestionBar);
            });
        });

        function clearAllQuestionSelections() {
            var selectAll = document.getElementById('selectAllCheckbox');
            if (selectAll) selectAll.checked = false;
            document.querySelectorAll('.question-checkbox').forEach(function(cb) {
                cb.checked = false;
            });
            updateBulkQuestionBar();
        }

        function executeBulkDeleteQuestions() {
            var checked = document.querySelectorAll('.question-checkbox:checked');
            if (checked.length === 0) {
                alert('অনুগ্রহ করে প্রথমে কমপক্ষে একটি প্রশ্ন নির্বাচন করুন।');
                return;
            }

            if (confirm('আপনি কি নিশ্চিতভাবে নির্বাচিত ' + checked.length + 'টি প্রশ্ন এই কুইজ থেকে মুছে ফেলতে চান? মুছে ফেললে কুইজের মোট নম্বর স্বয়ংক্রিয়ভাবে সমন্বয় করা হবে।')) {
                document.getElementById('bulkDeleteQuestionsForm').submit();
            }
        }
    </script>
@endsection
HTML;
$scriptCode = str_replace("\n", $eolView, $scriptCode);

if (strpos($qContent, 'updateBulkQuestionBar') === false) {
    $lastEndSection = strrpos($qContent, '@endsection');
    if ($lastEndSection !== false) {
        $qContent = substr($qContent, 0, $lastEndSection) . $scriptCode;
        file_put_contents($qViewFile, $qContent);
        echo "questions.blade.php updated successfully.\n";
    }
}
