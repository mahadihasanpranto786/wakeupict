<?php

namespace App\Http\Controllers\frontend\theme\clasic;

use App\Http\Controllers\Controller;
use App\Services\OmrService;
use App\model\LmsQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentOmrController extends Controller
{
    /**
     * Display the BTEB OMR Sheet & Litho Code Builder
     */
    public function index(Request $request)
    {
        $student = function_exists('student_user') ? student_user() : Auth::guard('student')->user();

        // 1. Initial Litho Code (From request or freshly generated)
        $lithoCode = $request->query('litho_code', OmrService::generateLithoCode());
        if (strlen($lithoCode) !== 10) {
            $lithoCode = OmrService::generateLithoCode();
        }

        // 2. Default Parameters
        $mode = $request->query('mode', 'guide'); // 'guide' (demo instructions), 'blank' (practice), 'student' (personalized)
        $curriculumCode = $request->query('curriculum_code', '30');
        $tradeCode = $request->query('trade_code', '76');
        $semester = $request->query('semester', '1');
        $roll = $request->query('roll', '');
        $rollBlank = filter_var($request->query('roll_blank', true), FILTER_VALIDATE_BOOLEAN);
        $registration = $request->query('registration', '');
        $session = $request->query('session', '0022');
        $subjectCode = $request->query('subject_code', '00076');
        $examYear = $request->query('exam_year', '2026');

        // If student is logged in and requested 'student' mode or initial load, pre-fill with student record
        if ($student && $mode === 'student') {
            if (!empty($student->student_id_code)) {
                // Extract clean digits for registration
                $cleanId = preg_replace('/[^0-9]/', '', $student->student_id_code);
                $registration = str_pad(substr($cleanId, 0, 11), 11, '0', STR_PAD_LEFT);
            }
        }

        // 3. Generate Visual Assets
        $barcodeSvg = OmrService::generateBarcodeSvg($lithoCode);
        $qrPayload = "BTEB-OMR|LITHO:{$lithoCode}|REG:{$registration}|SUB:{$subjectCode}|YR:{$examYear}";
        $qrSvg = OmrService::generateQrSvg($qrPayload, 76);

        return view('frontend.theme.clasic.student.omr.index', compact(
            'student',
            'lithoCode',
            'mode',
            'curriculumCode',
            'tradeCode',
            'semester',
            'roll',
            'rollBlank',
            'registration',
            'session',
            'subjectCode',
            'examYear',
            'barcodeSvg',
            'qrSvg'
        ));
    }

    /**
     * Clean Print View (A4 Board Standard)
     * Supports single sheet or batch multi-page printing with consecutive Litho codes
     */
    public function print(Request $request)
    {
        $startLitho = $request->query('start_litho', $request->query('litho_code', OmrService::generateLithoCode()));
        $count = max(1, min(50, (int)$request->query('count', 1)));
        $mode = $request->query('mode', 'guide'); // 'guide', 'blank', 'student'

        $curriculumCode = $request->query('curriculum_code', '30');
        $tradeCode = $request->query('trade_code', '76');
        $semester = $request->query('semester', '1');
        $roll = $request->query('roll', '');
        $rollBlank = filter_var($request->query('roll_blank', true), FILTER_VALIDATE_BOOLEAN);
        $registration = $request->query('registration', '');
        $session = $request->query('session', '0022');
        $subjectCode = $request->query('subject_code', '00076');
        $examYear = $request->query('exam_year', '2026');

        // Generate list of sheets with unique Litho codes
        $lithoCodes = OmrService::generateBatch($startLitho, $count);
        $sheets = [];

        foreach ($lithoCodes as $idx => $code) {
            $qrPayload = "BTEB-OMR|LITHO:{$code}|REG:{$registration}|SUB:{$subjectCode}|YR:{$examYear}";
            $sheets[] = [
                'index'          => $idx + 1,
                'litho_code'     => $code,
                'litho_code_bn'  => OmrService::toBengaliDigits($code),
                'barcode_svg'    => OmrService::generateBarcodeSvg($code, 220, 52),
                'qr_svg'         => OmrService::generateQrSvg($qrPayload, 76),
                'mode'           => $mode,
                'curriculum_code'=> $curriculumCode,
                'trade_code'     => $tradeCode,
                'semester'       => $semester,
                'roll'           => $roll,
                'roll_blank'     => $rollBlank,
                'registration'   => $registration,
                'session'        => $session,
                'subject_code'   => $subjectCode,
                'exam_year'      => $examYear,
                'exam_year_bn'   => OmrService::toBengaliDigits($examYear),
            ];
        }

        return view('frontend.theme.clasic.student.omr.print', compact('sheets', 'count', 'mode'));
    }

    /**
     * AJAX Generate Litho Code or Batch
     */
    public function generate(Request $request)
    {
        $action = $request->input('action', 'single');
        $prefix = $request->input('prefix', '20');

        if ($action === 'batch') {
            $start = $request->input('start_code', OmrService::generateLithoCode($prefix));
            $count = max(1, min(50, (int)$request->input('count', 5)));
            $codes = OmrService::generateBatch($start, $count);

            $result = [];
            foreach ($codes as $c) {
                $result[] = [
                    'code'        => $c,
                    'code_bn'     => OmrService::toBengaliDigits($c),
                    'barcode_svg' => OmrService::generateBarcodeSvg($c, 220, 50),
                    'qr_svg'      => OmrService::generateQrSvg("BTEB-OMR|LITHO:{$c}", 72),
                ];
            }

            return response()->json([
                'success' => true,
                'batch'   => $result,
                'count'   => count($result),
            ]);
        }

        $code = OmrService::generateLithoCode($prefix);
        return response()->json([
            'success'     => true,
            'litho_code'  => $code,
            'code_bn'     => OmrService::toBengaliDigits($code),
            'barcode_svg' => OmrService::generateBarcodeSvg($code, 240, 55),
            'qr_svg'      => OmrService::generateQrSvg("BTEB-OMR|LITHO:{$code}", 76),
        ]);
    }
}
