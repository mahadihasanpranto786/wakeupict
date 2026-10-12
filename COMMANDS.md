# Wake Up ICT — User Command Center & AI Brain (COMMANDS.md)

> **MANDATORY INSTRUCTION FOR AI AGENTS (Antigravity / Gemini / Cursor)**:  
> **YOU MUST READ THIS ENTIRE FILE AT THE START OF EVERY TASK BEFORE WRITING OR MODIFYING ANY CODE.**  
> All rules, commands, and preferences written here by the user are binding and take highest priority.

---

## 📌 1. Active User Directives & Commands (Edit Anytime)
*Add your custom instructions, project requirements, rules, or temporary directives below. The AI will read and obey them on every turn.*

1. **Theme Mode**: Always use **System Default** theme. Do not add manual theme toggle buttons to the header or navbars. The website must automatically detect and synchronize with the visitor's operating system / device theme (`prefers-color-scheme: dark` / `light`).
2. **Color Contrast**:
   - **Light Mode**: Background is light (`#FFFFFF`, `#F8FAFC`). Headings, body text, links, descriptions, and footer content MUST be **DARK, HIGH-CONTRAST** (`#0F172A`, `#1E293B`, `#334155`). Never use faint/washed-out grey text on light backgrounds.
   - **Dark Mode**: Background is deep dark (`#030712`, `#0B0F19`, `#0F172A`). Headings and text MUST be **CRISP LIGHT** (`#FFFFFF`, `#F1F5F9`, `#CBD5E1`).
3. **Typography / Font Family**: Use **Hind Siliguri** (`'Hind Siliguri', sans-serif`) globally across all frontend and student portal pages for crisp, elegant Bengali and English typography.
4. **Official Office Phone & Hotline**: Always use **`01791612121`** (`+880 1791-612121` / `01791-612121`).
5. **Course Structure**: All courses are conducted in interactive **group batches with multiple students** in high-tech computer labs — **NOT 1:1**. Never use "১:১" in course descriptions or marketing text.
6. **Backend-Driven Frontend Menus**: All frontend header and footer menus must be dynamically managed from the Admin Portal (`/admin/appearance/menus`). Navbar menu items must never wrap into two lines (`whitespace-nowrap`).
7. **Offline LMS Operations**:
   - The platform manages physical/offline classroom training batches.
   - Course curriculum, exams, and attendance are geared towards offline/hybrid training.
   - Certificates are published from the Admin Portal upon batch completion, after which they become visible in the Student Portal.
   - Quizzes are bulk-uploaded via Excel/CSV by category and course.
8. **Code Stability & Testing**:
   - Always run `vendor\bin\phpunit` before completing tasks. All 47+ tests must pass with zero failures.
   - Maintain clean Blade code, PSR standards, and preserve existing routes and controllers.

---

## 🎨 2. Design System & Theme Standards

| Element | Light Theme (`html.light`) | Dark Theme (`html.dark`) |
| :--- | :--- | :--- |
| **Trigger** | OS set to Light Mode (`prefers-color-scheme: light`) | OS set to Dark Mode (`prefers-color-scheme: dark`) |
| **Page Background** | `#F8FAFC` / `#FFFFFF` | `#030712` / `#0B0F19` |
| **Card / Surface Background** | `#FFFFFF` with `#E2E8F0` border | `#0F172A` / `#1E293B` |
| **Headings (`h1`–`h6`)** | Deep Dark Navy `#0F172A` | Pure White `#FFFFFF` |
| **Body & Paragraph Text** | Charcoal `#1E293B` / Slate `#334155` | Light Slate `#CBD5E1` / `#F1F5F9` |
| **Links** | `#1E293B` (hover: `#047857` Emerald) | `#CBD5E1` (hover: `#FFFFFF`) |
| **Footer Background** | `#FFFFFF` with `#E2E8F0` border | `#0B0F19` with `#1E293B` border |
| **Footer Text & Links** | Dark `#1E293B` / `#334155` | Light `#CBD5E1` |
| **Footer Section Titles** | Dark Emerald `#047857` | Mint Emerald `#34D399` |
| **Font Family** | Hind Siliguri (`'Hind Siliguri'`, sans-serif) | Hind Siliguri (`'Hind Siliguri'`, sans-serif) |

---

## 🎓 3. Student Portal & Offline LMS Architecture

1. **Offline Batch Management**:
   - Real-world classroom batches with lab seating, offline schedules, and physical attendance tracking.
2. **Certificate Workflow**:
   - Status: `Draft` (hidden from student) -> `Published / Completed` (visible in student portal for PDF download and verification).
   - Public QR verification route: `/verify-certificate/{code}`.
3. **Quiz & Examination Workflow**:
   - Excel upload format: `Question, Option A, Option B, Option C, Option D, Correct Answer, Explanation, Marks`.
   - Real-time quiz timer and results breakdown.
4. **Student Portal Menus**:
   - Dynamically loaded via `\App\Services\StudentMenuService::getTree()`.
   - Manageable from Admin Portal (`/admin/student-menus`).

---

## 🛠️ 4. Essential Development & Testing Commands

```bash
# Run complete test suite (must always pass 100%)
vendor\bin\phpunit

# Clear application caches
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# Run database migrations
php artisan migrate

# Seed dummy data
php artisan db:seed
```

---

## 📝 5. User Notes & Custom Log
*Write any notes, ideas, or to-do items here:*
- [x] Removed manual theme dropdown from header navbar; switched to automatic System Default theme detection.
- [x] Switched typography to native System Default font stack with Bengali support.
- [x] Created `COMMANDS.md`, `BRAIN.md`, and `AGENTS.md` for permanent agent instruction loading.
