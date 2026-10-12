# Wake Up ICT — Student Panel & Learning Management System (LMS)
## Master Progress & Implementation Specification

> **Platform**: Wake Up ICT ([wakeupict.com](https://wakeupict.com))  
> **Framework**: Laravel 5.8.38 / PHP 7.4.33 / MySQL (`wakeupict_main_db`)  
> **Styling**: Tailwind CSS (Frontend Design System) + AdminLTE/Bootstrap (Backend Management)  
> **Status**: Phase 6 Completed (Course Fees, Installments, Online Payments, Money Receipts & Verifiable Certificates) — Ready for Phase 7  
> **Last Updated**: October 12, 2026

---

## 1. Codebase Audit Findings

### 1.1 Environment & Architecture
- **Framework & Core**: Laravel 5.8.38, running on PHP 7.4.33 under Laravel Herd / Windows environment.
- **Database Engine**: MySQL 8.x / MariaDB (`wakeupict_main_db`), 60 tables verified from `sql/local_updated_wakeupict_main_db.sql`.
- **Existing Asset Pipeline**:
  - Public Frontend: Powered by customized Tailwind CSS v3 via CDN script in `resources/views/frontend/theme/clasic/frontend_layouts/master_layout.blade.php`, with Google Fonts (`Plus Jakarta Sans`, `Inter`, `Noto Sans Bengali`, `JetBrains Mono`), dark/light theme toggle, custom CSS variables (`--brand-primary`, `--brand-accent`, `--brand-cyan`, `--brand-indigo`), Font Awesome, Toastr notifications.
  - Backend Admin: AdminLTE v3 style dashboard in `resources/views/backend/theme/clasic/admin_layouts/admin_master.blade.php`.
- **Libraries Available**:
  - `intervention/image: ^2.6` (Image processing & resize)
  - `maatwebsite/excel: ^3.1` (Spreadsheet import/export)
  - `fideloper/proxy: ^4.0` (Trusted proxies)
  - `phpunit/phpunit: ^7.5` (Automated testing suite)

### 1.2 Authentication & User Roles
- Existing `users` table:
  - Columns: `id`, `name`, `email`, `type` (`Admin`, `Moderator`, `Employee`), `excess_type` (`1` = Local, `2` = Global, `3` = All), `employee_type`, `nid_number`, `designation_id`, `photo`, `status`, `password`.
  - In `HomeController@index`, non-admin/moderator/employee accounts currently redirect to `/`.
  - Student accounts do not yet exist in `users`.
- Role & Permission Architecture:
  - `modules` table (77 records) and `user_rolls` table define internal employee permissions.
  - `AppearanceSetting` model & `appearance_settings` table store persistent key-value configuration (`section`, `key`, `value_en`, `value_bn`, `meta` JSON) with caching layer (`Cache::remember('appearance_settings_all', 3600)`).

### 1.3 Course & Student Data Structures
- **Courses**: `courses` table contains 6 production courses:
  1. *গ্রাফিক্স ডিজাইন কোর্স* (Graphic Design, ID 1)
  2. *ডিজিটাল মার্কেটিং কোর্স* (Digital Marketing, ID 2)
  3. *ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট কোর্স* (Web Design & Development, ID 3)
  4. *অ্যাডভান্স গ্রাফিক ডিজাইন কোর্স* (Advanced Graphic Design, ID 4)
  6. *এডভান্স ওয়েব ডিজাইন এন্ড ডেভেলপমেন্ট কোর্স* (Advanced Web Design & Development, ID 6)
  10. *Microsoft Office Course* (ID 10)
  - Relational tables: `course_items` (24 curriculum topics), `course_fassilities`, `course_members`.
- **Batches**: `batches` table (`batch_number`, `course_id`, `title_id`, `batch_type` [Local/Global], `active_batch`, `status`).
- **Student Admissions**:
  - `students`: Inbound online registrations / applicant leads from public registration form (`/training/{slug}/student-registration`).
  - `admited_students`: Formally admitted students enrolled in specific batches (`course_after_discount`, `discount_amount`, `student_type`, etc.).
  - `student_payments`: Fee transactions linked to `admited_students.id` and `incomes` accounting.

### 1.4 Reusable Components Identified
1. **Frontend Master Layout & Design Tokens**:
   - `resources/views/frontend/theme/clasic/frontend_layouts/master_layout.blade.php`
   - Glassmorphism cards, glowing borders (`shadow-glow-emerald`), animated gradients, dark/light theme toggler, preloader, responsive mobile navigation.
2. **Settings & Dynamic Config System**:
   - `App\model\AppearanceSetting` and `app_setting($key, $default)` helper.
   - Ideal foundation for caching and managing the Dynamic Student Panel Menu.
3. **Upload Helpers**:
   - `uploadPlease()` and `uploadPleaseWithSize()` in `app/Http/Helper/common.php`.
4. **Existing Accounting & Payment Hook**:
   - `StudentPayment` model connected to `Income` records, preserving financial reporting integrity.

---

## 2. Dynamic Menu Architecture Specification

As mandated in the project requirements:
1. **Database-Driven Structure**:
   - Stored in a dedicated table `student_panel_menus` (or cached configuration with fallback).
   - Fields: `id`, `parent_id`, `menu_key`, `title_en`, `title_bn`, `route_name`, `url_pattern`, `icon_class`, `order_index`, `is_active`, `required_permission`, `badge_callback`, `meta` (JSON).
2. **Backend Management Interface**:
   - **Student Panel Menu Builder**: Accessible at `/admin/student-menus` (linked under Admin Sidebar > Student > Student Dynamic Menus). Actions: Enable/disable toggle, edit label (EN & BN), icon picker, order index, reset to defaults.
   - **Universal Frontend Menu Builder**: Accessible at `/admin/appearance/menus` (linked under Admin Sidebar > Appearance CMS > Frontend Menus). Actions: Manage Main Header navigation bar, dropdown submenus, and Footer Quick Links with multi-level nesting, custom URLs or Laravel route names, bilingual titles, badge indicators, and factory reset.
3. **Independent Security Enforcement**:
   - Dynamic menus control UI presentation (desktop sidebar, mobile drawer, top breadcrumbs).
   - Routes, controllers, and APIs strictly enforce policy independently via middleware (`CheckStudentFeatureActive`, `auth:student` / student authorization) so disabling a menu safely locks down access without dropping database records.
4. **Initial Default Menu Tree**:
   - **Dashboard** (`student.dashboard`)
   - **My Learning** (Parent)
     - *My Courses* (`student.courses.my`)
     - *Browse Courses* (`student.courses.browse`)
     - *Learning Materials* (`student.materials.index`)
     - *Course Progress* (`student.progress.index`)
   - **Classes & Attendance** (Parent)
     - *Class Schedule* (`student.schedule.index`)
     - *Attendance History* (`student.attendance.index`)
     - *Live Classes* (`student.live.index`)
     - *Recorded Classes* (`student.recorded.index`)
   - **Quiz & Examination** (Parent)
     - *Upcoming Exams* (`student.exams.upcoming`)
     - *Online Quiz* (`student.quiz.index`)
     - *Practice Tests* (`student.practice.index`)
     - *Results* (`student.results.index`)
     - *Exam History* (`student.exams.history`)
   - **Assignments & Projects** (Parent)
     - *My Assignments* (`student.assignments.index`)
     - *Submit Assignment* (`student.assignments.submit`)
     - *Project Submissions* (`student.projects.index`)
     - *Teacher Feedback* (`student.assignments.feedback`)
   - **Fees & Payments** (Parent)
     - *Course Fees* (`student.fees.index`)
     - *Payment History* (`student.payments.history`)
     - *Outstanding Dues* (`student.dues.index`)
     - *Receipts* (`student.receipts.index`)
   - **Certificates & Achievements** (`student.certificates.index`)
   - **Notifications & Announcements** (`student.notifications.index`)
   - **Support & Communication** (`student.support.index`)
   - **My Profile & Settings** (`student.profile.index`)

---

## 3. Academic ICT (Classes 6–10) & Course Tracks

The Student Panel and LMS will support two primary educational tracks:
1. **Professional / Vocational Track**:
   - Microsoft Office (Word, Excel, PowerPoint, Access, Outlook)
   - Web Design & Development (HTML5, CSS3, JavaScript, PHP, Laravel, MySQL)
   - Graphic Design & Advanced Graphic Design (Photoshop, Illustrator, Branding, UI Design)
   - Digital Marketing (SEO, Social Media Marketing, Analytics, Content Strategy)
   - Artificial Intelligence (AI Tools, Prompt Engineering, Machine Learning Fundamentals)
2. **School Academic Track (Classes 6–10)**:
   - National Curriculum & Textbook Board (NCTB) ICT Syllabus
   - Class 6 ICT (Fundamentals, Hardware/Software, Daily Life Applications)
   - Class 7 ICT (Computer Network, Safe & Ethical Use, Spreadsheet Basics)
   - Class 8 ICT (Communication, Network Topology, Cyber Security, Spreadsheet & Database)
   - Class 9–10 ICT (Information & Communication Technology, Safe Web Usage, Digital Content, Multimedia, Graphics & Programming Basics)
   - Features: Chapter-wise lesson notes, downloadable PDF guides, interactive MCQs, multiple-select, true/false, fill-in-the-blanks, board-standard practice exams, instant auto-grading, and progress tracking.

---

## 4. Phase-by-Phase Implementation Roadmap

### Phase 1: Audit and Implementation Plan *(Current Phase - Completed)*
- [x] Inspect existing framework (Laravel 5.8.38 / PHP 7.4.33).
- [x] Audit database schema (60 tables in `wakeupict_main_db`).
- [x] Analyze authentication, roles, modules, appearance settings, and existing course/student workflows.
- [x] Verify existing test suite (`vendor/bin/phpunit`).
- [x] Design dynamic menu data model and admin configuration specification.
- [x] Create project progress specification document (`STUDENT_LMS_PROGRESS.md`).

### Phase 2: Student Authentication, Profiles, Unique IDs & Access Control *(Completed & Verified)*
- [x] Safe database migrations: Created `student_accounts` (`student_id_code`, `admited_student_id`, `name`, `email`, `phone`, `password`, `avatar`, `status`, `last_login_at`, `last_login_ip`, `remember_token`) and `student_panel_menus` tables.
- [x] Unique Student ID generation engine implemented in `StudentAccount::generateUniqueStudentId()` (`WUICT-YYYY-XXXX`).
- [x] Multi-guard authentication: Added `student` guard, `students` provider in `config/auth.php`, `StudentAuthController` with login, register, claim account, logout, session persistence.
- [x] Student profile management: `StudentProfileController` with profile view, avatar photo upload (via Intervention Image), address & contact update, password change.
- [x] Dynamic Student Panel Menu system: `student_panel_menus` migration, `StudentMenuService` (caching, hierarchical tree, feature toggle, default seeder with 10 parent menus & submenus), and backend admin management interface (`StudentMenuController` & view).
- [x] Feature authorization middleware: `CheckStudentFeatureActive` blocks disabled modules with polite 403 screen without deleting existing data.
- [x] Responsive Student Panel Layout: `student_layout.blade.php` with dynamic desktop sidebar, mobile drawer, ambient lighting, profile dropdown, theme toggler, breadcrumbs.
- [x] Unit & Feature tests: `tests/Feature/StudentAuthAndMenuTest.php` passing 100% with 8 tests and 33 assertions.

### Phase 3: Dashboard, Courses, Enrollment, Lessons, Videos, PDFs & Progress *(Completed & Verified)*
- [x] Safe migrations: Created `lms_chapters`, `lms_lessons`, `lms_enrollments`, and `lms_lesson_progress` tables via `2026_10_12_030000_create_lms_courses_and_curriculum_tables.php`.
- [x] Eloquent models & relationships: `LmsChapter`, `LmsLesson`, `LmsEnrollment`, and `LmsLessonProgress` with duration formatters, YouTube/Vimeo embed URL parsers, and enrollment progress calculation.
- [x] Multi-track curriculum seeded: 10 structured chapters and 18 lessons covering Web Development, Graphic Design, Microsoft Office, Digital Marketing, Artificial Intelligence, and Academic ICT (Classes 6–10 NCTB).
- [x] Controller implementation: `StudentCourseController` handling `myCourses`, `browseCourses`, `courseDetails`, `enroll`, `learn` interactive player, `toggleLessonComplete` AJAX endpoint, `materials` repository, and `progress` milestones.
- [x] Interactive Lesson Player view: `learn.blade.php` with responsive video embeds, lecture sheet PDF downloads, dynamic chapter/lesson playlist sidebar, prev/next lesson navigation, and instant AJAX completion toggling without full-page reloads.
- [x] Centralized Learning Materials & Progress views: `details.blade.php`, `materials.blade.php`, and `progress.blade.php` with responsive dark/light styling and bilingual typography.
- [x] Automated test suite: `tests/Feature/LmsCourseAndProgressTest.php` passing 100% (6 tests, 24 assertions). Full project test suite running 14 tests, 57 assertions passing 100%.

### Phase 4: Quizzes, Exams, Grading, Results & Academic ICT (Classes 6–10) *(Completed & Verified)*
- [x] Safe migrations: Created `lms_quizzes`, `lms_questions`, `lms_question_options`, `lms_quiz_attempts`, and `lms_quiz_answers` tables via `2026_10_12_040000_create_lms_quizzes_and_exams_tables.php`.
- [x] Eloquent models & relationships: `LmsQuiz`, `LmsQuestion`, `LmsQuestionOption`, `LmsQuizAttempt`, and `LmsQuizAnswer` with pass/fail evaluation, formatted duration, option decoder, and attempt eligibility checking.
- [x] Comprehensive Academic & Professional question banks seeded: `LmsQuizSeeder` loaded 6 rich assessments with 25 authentic questions covering Class 6–7 NCTB ICT, Class 8–10 SSC Model Tests, Web Development, Graphic Design, Microsoft Office, and Artificial Intelligence.
- [x] Controller implementation: `StudentQuizController` handling `onlineQuiz`, `upcomingExams`, `practiceTests`, `lobby` briefing, `startQuiz`, `takeQuiz` exam hall, `saveAnswer` background autosave AJAX endpoint, `submitQuiz` auto-grading calculator, `quizResults` review sheet, and `allResults`/`examHistory` archive.
- [x] Live Exam Simulator view: `take.blade.php` featuring server-synchronized countdown timer, question palette navigator (answered/unanswered indicators), instant AJAX autosave on option selection, anti-cheat tab-blur warning, and confirm submission modal.
- [x] Results & Review views: `index.blade.php`, `upcoming.blade.php`, `practice.blade.php`, `lobby.blade.php`, `result.blade.php`, and `history.blade.php` with score breakdowns, pass/fail badges, and question-by-question explanations.
- [x] Automated test suite: `tests/Feature/LmsQuizAndExamTest.php` passing 100% (3 tests, 30 assertions). Full suite running 17 tests, 87 assertions passing 100%.

### Phase 5: Schedules, Attendance, Assignments & Projects *(Completed & Verified)*
- [x] Safe migrations: Created `lms_class_schedules`, `lms_attendances`, `lms_assignments`, and `lms_assignment_submissions` tables via `2026_10_12_050000_create_lms_schedules_attendance_and_assignments_tables.php`.
- [x] Eloquent models & relationships: `LmsClassSchedule`, `LmsAttendance`, `LmsAssignment`, and `LmsAssignmentSubmission` with live status detection (`isLiveNow()`), time formatters, submission file getters, and grade evaluators.
- [x] Multi-track schedules & assignments seeded: `LmsScheduleAndAssignmentSeeder` loaded live Zoom/Google Meet sessions, offline campus labs, recorded lecture replays, and realistic coursework briefs for Web Development, Graphic Design, Academic ICT (Classes 6–10 NCTB), and AI.
- [x] Controller implementation: `StudentScheduleController` (`schedule`, `attendance`, `liveClasses`, `recordedClasses`) and `StudentAssignmentController` (`assignments`, `showSubmit`, `storeSubmission`, `projects`, `feedback`).
- [x] Dedicated UI views: `schedule.blade.php`, `attendance.blade.php`, `live.blade.php`, `recorded.blade.php`, `assignments/index.blade.php`, `assignments/submit.blade.php`, `assignments/submit_select.blade.php`, `assignments/projects.blade.php`, and `assignments/feedback.blade.php`.
- [x] Automated test suite: `tests/Feature/LmsScheduleAndAssignmentTest.php` passing 100% (3 tests, 22 assertions). Full project test suite running 20 tests, 109 assertions passing 100%.

### Phase 6: Fees, Installments, Verified Payments, Receipts & Certificates *(Completed & Verified)*
- [x] Safe migrations: Created `lms_payment_submissions`, `lms_fee_installments`, and `lms_certificates` tables via `2026_10_12_060000_create_lms_payments_and_certificates_tables.php`.
- [x] Eloquent models & relationships: `LmsPaymentSubmission`, `LmsFeeInstallment`, and `LmsCertificate` with receipt serial generator (`REC-YYYY-XXXXXX`), due calculations, and unique verifiable certificate codes (`CERT-WUICT-YYYY-XXXX`).
- [x] Seamless accounting integration: Combined existing campus admission records (`student_payments`) with modern digital payment notifications (bKash, Nagad, Rocket, Bank Deposit).
- [x] Controller implementation: `StudentPaymentController` (`fees`, `submitPayment`, `paymentHistory`, `outstandingDues`, `receipts`, `printReceipt`) and `StudentCertificateController` (`certificates`, `viewCertificate`, `verifyCertificate`).
- [x] Dedicated UI views: `payments/fees.blade.php`, `payments/history.blade.php`, `payments/receipts.blade.php`, official printable `payments/receipt_print.blade.php`, `certificates/index.blade.php`, ultra-premium `certificates/view.blade.php`, and public `certificates/verify_public.blade.php`.
- [x] Automated test suite: `tests/Feature/LmsPaymentAndCertificateTest.php` passing 100% (4 tests, 26 assertions). Full project test suite running 24 tests, 135 assertions passing 100%.

### Phase 7: Notifications, Support, Admin/Instructor Integration & Reports *(Completed & Verified)*
- [x] Safe migrations: Created `lms_notifications`, `lms_support_tickets`, and `lms_ticket_replies` tables via `2026_10_12_070000_create_lms_notifications_and_support_tables.php`.
- [x] Eloquent models & relationships: `LmsNotification`, `LmsSupportTicket`, and `LmsTicketReply` with ticket number generator (`TKT-YYYY-XXXXX`), student relations, and staff reply bindings.
- [x] Notification center: Real-time alert counts, unread filters, institutional announcements broadcast feed, AJAX mark-as-read, and mark-all-read bulk action.
- [x] Top navigation integration: Live notification bell icon in `student_layout.blade.php` displaying pulsing unread count badge.
- [x] Helpdesk & Support tickets: Support center with stats cards, category/priority selectors, file attachment upload, interactive conversation thread view, and auto-reopening student reply composer.
- [x] Dedicated UI views: `notifications/index.blade.php`, `support/index.blade.php`, `support/create.blade.php`, and `support/show.blade.php`.
- [x] Automated test suite: `tests/Feature/LmsNotificationAndSupportTest.php` passing 100% (8 tests, 25 assertions). Full project test suite running 32 tests, 160 assertions passing 100%.

### Phase 8: Security, Regression Tests, Documentation & Deployment Readiness *(Completed & Verified)*
- [x] Comprehensive security audit:
  - CSRF verification enforced across all student form submissions.
  - SQL injection protection via parameterized Eloquent ORM queries.
  - Strict student tenant isolation (all operations scoped to authenticated student ID).
  - Secure file upload validation with MIME type restriction and size quotas (5MB).
  - Feature-level menu gates via `CheckStudentFeatureActive` middleware.
- [x] Regression testing of existing website:
  - Zero modification to existing admissions tables, course registrations, or accounting ledgers.
  - Backward compatibility confirmed for public landing pages and admin backend.
- [x] Full automated test suite passing 100%: 39 tests, 176 assertions in 3.6s (`phpunit`).
- [x] Route registration: All 35+ student endpoints, public certificate verification portal, and frontend menu builder registered and active in `routes/web.php`.

---

## 5. Verification & Architectural Metrics
- [x] **Framework & Runtime**: Laravel 5.8.38 on PHP 7.4.33 (Windows Herd / MySQL `wakeupict_main_db`).
- [x] **Database Tables Added (Safe Migrations)**:
  1. `student_accounts`
  2. `student_panel_menus`
  3. `frontend_menus`
  4. `lms_chapters`
  5. `lms_lessons`
  6. `lms_enrollments`
  7. `lms_lesson_progress`
  8. `lms_quizzes`
  9. `lms_questions`
  10. `lms_question_options`
  11. `lms_quiz_attempts`
  12. `lms_quiz_answers`
  13. `lms_class_schedules`
  14. `lms_attendances`
  15. `lms_assignments`
  16. `lms_assignment_submissions`
  17. `lms_payment_submissions`
  18. `lms_fee_installments`
  19. `lms_certificates`
  20. `lms_notifications`
  21. `lms_support_tickets`
  22. `lms_ticket_replies`
- [x] **Feature Test Coverage**:
  - `tests/Feature/StudentAuthAndMenuTest.php` (8 tests, 33 assertions)
  - `tests/Feature/LmsCourseAndProgressTest.php` (6 tests, 24 assertions)
  - `tests/Feature/LmsQuizAndExamTest.php` (3 tests, 30 assertions)
  - `tests/Feature/LmsScheduleAndAssignmentTest.php` (3 tests, 22 assertions)
  - `tests/Feature/LmsPaymentAndCertificateTest.php` (4 tests, 26 assertions)
  - `tests/Feature/LmsNotificationAndSupportTest.php` (8 tests, 25 assertions)
  - `tests/Feature/FrontendMenuManagementTest.php` (7 tests, 16 assertions)
  - **Total**: 39 tests, 176 assertions (100% Passing).
