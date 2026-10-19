@extends('backend.theme.clasic.admin_layouts.admin-master')

@section('title', 'Drag-and-Drop Paper Builder: ' . $paper->title)

@section('student_portal_active', 'menu-open')
@section('menu_active_student_portal', 'active')
@section('lms_question_paper_active', 'active')

@section('maincontant')
    <!-- Custom Paper Studio Styling -->
    <style>
        .builder-layout {
            display: flex;
            gap: 1rem;
            min-height: calc(100vh - 140px);
        }
        .builder-left-panel {
            width: 380px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            background: #ffffff;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }
        .builder-canvas-panel {
            flex-grow: 1;
            background: #f8fafc;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            padding: 1.25rem;
            overflow-y: auto;
        }
        .builder-right-panel {
            width: 340px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        @media (max-width: 1200px) {
            .builder-layout {
                flex-direction: column;
            }
            .builder-left-panel, .builder-right-panel {
                width: 100%;
            }
        }
        .draggable-library-card {
            cursor: grab;
            transition: all 0.2s ease;
            user-select: none;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
        }
        .draggable-library-card:hover {
            border-color: #3b82f6;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
            transform: translateY(-2px);
        }
        .draggable-library-card:active {
            cursor: grabbing;
        }
        .paper-sheet {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 0.5rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            margin: 0 auto;
            max-width: 900px;
            min-height: 800px;
        }
        .section-dropzone {
            min-height: 90px;
            border: 2px dashed #cbd5e1;
            border-radius: 0.5rem;
            padding: 0.75rem;
            background: #f8fafc;
            transition: all 0.25s ease;
        }
        .section-dropzone.drag-over {
            border-color: #10b981;
            background: #ecfdf5;
            box-shadow: 0 0 15px rgba(16, 185, 129, 0.2);
        }
        .canvas-question-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.85rem;
            margin-bottom: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            transition: all 0.25s ease;
            position: relative;
        }
        .canvas-question-card:hover {
            border-color: #94a3b8;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.08);
        }
        .canvas-question-card.just-added {
            animation: highlightFade 1.2s ease forwards;
        }
        @keyframes highlightFade {
            0% { background-color: #ecfdf5; border-color: #10b981; transform: scale(1.02); }
            100% { background-color: #ffffff; border-color: #e2e8f0; transform: scale(1); }
        }
        .drag-handle {
            cursor: grab;
            color: #94a3b8;
        }
        .drag-handle:hover {
            color: #3b82f6;
        }
        /* Toast Alert Container */
        #builderToastContainer {
            position: fixed;
            top: 20px;
            right: 25px;
            z-index: 99999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            pointer-events: none;
        }
        .builder-toast {
            min-width: 280px;
            max-width: 380px;
            padding: 12px 18px;
            border-radius: 8px;
            color: #ffffff;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(0,0,0,0.25);
            pointer-events: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: slideInRight 0.3s ease;
            transition: all 0.3s ease;
        }
        .builder-toast.toast-success { background: #059669; }
        .builder-toast.toast-danger { background: #dc2626; }
        .builder-toast.toast-info { background: #0284c7; }
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>

    <!-- Floating Toast Notification Container -->
    <div id="builderToastContainer"></div>

    <!-- Top Action Bar -->
    <div class="card shadow-sm border-0 mb-3 bg-white">
        <div class="card-body py-2 px-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
            <div class="d-flex align-items-center">
                <a href="{{ route('admin.question-papers.index') }}" class="btn btn-sm btn-outline-secondary mr-3">
                    <i class="fas fa-arrow-left mr-1"></i> তালিকা
                </a>
                <div>
                    <h5 class="mb-0 font-weight-bold text-dark">
                        {{ $paper->title }}
                        <span class="badge badge-warning text-dark ml-2">{{ \App\model\LmsQuestionPaper::getBengaliSetCode($paper->paper_set) }}</span>
                    </h5>
                    <div class="text-xs text-muted">
                        কোড: <strong>{{ $paper->paper_code }}</strong> | বিষয় কোড: <strong>{{ $paper->subject_code }}</strong> | শিক্ষাবর্ষ: <strong>{{ $paper->academic_year }}</strong>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center flex-wrap gap-2">
                <span id="autosaveIndicator" class="badge badge-light border text-muted mr-2">
                    <i class="fas fa-check-circle text-success mr-1"></i> ড্রাফট সক্রিয়
                </span>
                <button type="button" class="btn btn-sm btn-outline-info mr-1" data-toggle="modal" data-target="#autoPickModal">
                    <i class="fas fa-magic mr-1"></i> অটো প্রশ্ন বাছাই
                </button>
                <a href="{{ route('admin.question-papers.print-board', $paper->id) }}" target="_blank" class="btn btn-sm btn-outline-dark mr-1">
                    <i class="fas fa-print mr-1"></i> বোর্ড প্রিন্ট
                </a>
                <a href="{{ route('admin.question-papers.teacher-key', $paper->id) }}" target="_blank" class="btn btn-sm btn-outline-success mr-1">
                    <i class="fas fa-key mr-1"></i> উত্তরপত্র
                </a>
                <button type="button" class="btn btn-sm btn-primary font-weight-bold" onclick="savePaperDraft(true)">
                    <i class="fas fa-save mr-1"></i> ড্রাফট সংরক্ষণ
                </button>
            </div>
        </div>
    </div>

    <!-- 3-Panel Builder Layout -->
    <div class="builder-layout">
        
        <!-- LEFT PANEL: Question Book Library Drawer -->
        <div class="builder-left-panel">
            <div class="p-3 bg-light border-bottom">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="mb-0 font-weight-bold text-dark">
                        <i class="fas fa-book-open text-primary mr-1"></i> প্রশ্ন লাইব্রেরি
                    </h6>
                    <span class="badge badge-secondary" id="libTotalCountBadge">{{ $libraryQuestions->total() }}টি প্রশ্ন</span>
                </div>
                <!-- Instant AJAX Search -->
                <div class="input-group input-group-sm mb-2">
                    <input type="text" id="libSearchInput" class="form-control" placeholder="প্রশ্ন বা টপিক খুঁজুন..." oninput="debounceLibrarySearch()">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button" onclick="loadLibraryQuestionsAJAX()">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <!-- Library Filter Dropdowns -->
                <div class="row g-1">
                    <div class="col-6">
                        <select id="libCategoryFilter" class="form-control form-control-sm custom-select text-xs" onchange="loadLibraryQuestionsAJAX()">
                            <option value="">-- ক্যাটাগরি --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}">{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <select id="libDiffFilter" class="form-control form-control-sm custom-select text-xs" onchange="loadLibraryQuestionsAJAX()">
                            <option value="">-- কঠিন্যতা --</option>
                            <option value="easy">সহজ</option>
                            <option value="medium">মাঝারি</option>
                            <option value="hard">কঠিন</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Library Items List -->
            <div class="p-2 overflow-auto flex-grow-1" style="max-height: calc(100vh - 270px);" id="libraryScrollContainer">
                @forelse($libraryQuestions as $lq)
                    <div class="draggable-library-card p-2 mb-2" 
                         draggable="true" 
                         ondragstart="onDragStartLibrary(event, {{ $lq->id }})"
                         data-question-id="{{ $lq->id }}">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div>
                                <span class="badge badge-light border text-muted">#{{ $lq->id }}</span>
                                <span class="badge badge-info text-xs">{{ $lq->getTypeLabel() }}</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge badge-pill badge-success mr-2 font-weight-bold">
                                    {{ \App\model\LmsQuiz::toBengaliNumber($lq->marks) }}
                                </span>
                                <button type="button" class="btn btn-xs btn-outline-primary" onclick="addQuestionToActiveSection({{ $lq->id }})" title="প্রশ্নপত্রে যোগ করুন">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        @if($lq->stimulus)
                            <div class="text-xs text-muted font-italic mb-1 text-truncate">
                                <strong>উদ্দীপক:</strong> {{ $lq->stimulus }}
                            </div>
                        @endif

                        <div class="font-weight-bold text-dark text-xs mb-1" style="line-height: 1.3;">
                            {{ $lq->question_text }}
                        </div>

                        @if($lq->options->isNotEmpty())
                            <div class="text-xs text-muted">
                                {{ $lq->options->count() }}টি অপশন | <span class="text-info">{{ $lq->category ?: 'General' }}</span>
                            </div>
                        @endif
                    </div>
                @empty
                    <div class="text-center py-4 text-muted text-xs">
                        <i class="fas fa-search fa-2x mb-2 text-muted"></i>
                        <p>কোনো প্রশ্ন পাওয়া যায়নি।</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- CENTER PANEL: The Visual Paper Canvas -->
        <div class="builder-canvas-panel">
            <div class="paper-sheet" id="paperSheet">
                
                <!-- Board Examination Header -->
                <div class="text-center border-bottom pb-3 mb-4">
                    <div class="text-uppercase tracking-wider font-weight-bold text-xs text-muted mb-1">
                        {{ $paper->board_name }}
                    </div>
                    <h3 class="font-weight-bold text-dark mb-1" style="font-size: 1.4rem;">
                        {{ $paper->exam_name }}
                    </h3>
                    <div class="h5 font-weight-bold text-primary mb-2">
                        {{ $paper->subject_name }}
                    </div>
                    <div class="d-flex justify-content-center align-items-center flex-wrap gap-3 text-sm text-dark font-weight-bold">
                        <span>বিষয় কোড: {{ \App\model\LmsQuiz::toBengaliNumber($paper->subject_code) }}</span>
                        <span>|</span>
                        <span>সময়: {{ \App\model\LmsQuiz::toBengaliNumber($paper->duration_minutes) }} মিনিট</span>
                        <span>|</span>
                        <span>পূর্ণমান: <strong id="headerTargetMarks">{{ \App\model\LmsQuiz::toBengaliNumber($paper->total_marks) }}</strong></span>
                        <span>|</span>
                        <span class="badge badge-dark">{{ \App\model\LmsQuestionPaper::getBengaliSetCode($paper->paper_set) }}</span>
                    </div>
                    @if($paper->instructions)
                        <div class="mt-3 p-2 border rounded bg-light text-xs text-muted text-left font-italic">
                            {!! nl2br(e($paper->instructions)) !!}
                        </div>
                    @endif
                </div>

                <!-- Sections Container -->
                <div id="paperSectionsContainer">
                    @forelse($paper->sections as $secIndex => $sec)
                        <div class="paper-section-block mb-4" data-section-id="{{ $sec->id }}" id="sec_block_{{ $sec->id }}">
                            <!-- Section Title Bar -->
                            <div class="d-flex justify-content-between align-items-center bg-light p-2.5 rounded border mb-2">
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-dark mr-2 font-weight-bold">{{ $sec->section_code }}</span>
                                    <h6 class="mb-0 font-weight-bold text-dark">{{ $sec->title }}</h6>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-pill badge-primary mr-2 sec-item-count" id="sec_count_{{ $sec->id }}">
                                        {{ \App\model\LmsQuiz::toBengaliNumber($sec->items->count()) }} টি প্রশ্ন
                                    </span>
                                    <button type="button" class="btn btn-xs btn-outline-danger" onclick="deleteSectionAJAX({{ $sec->id }})" title="সেকশন মুছুন">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>

                            @if($sec->instructions)
                                <div class="text-xs text-muted font-italic mb-2 pl-1">
                                    {{ $sec->instructions }}
                                </div>
                            @endif

                            <!-- Droppable Items Area -->
                            <div class="section-dropzone" 
                                 ondragover="onDragOverZone(event)" 
                                 ondragleave="onDragLeaveZone(event)" 
                                 ondrop="onDropZone(event, {{ $sec->id }})" 
                                 id="dropzone_{{ $sec->id }}">
                                
                                @forelse($sec->items as $itemIndex => $item)
                                    <div class="canvas-question-card" 
                                         id="item_card_{{ $item->id }}" 
                                         data-item-id="{{ $item->id }}" 
                                         data-question-id="{{ $item->question_id }}"
                                         draggable="true"
                                         ondragstart="onDragStartCard(event, {{ $item->id }})">
                                        
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-grip-vertical drag-handle mr-2" title="ড্র্যাগ করে সাজান"></i>
                                                <span class="badge badge-secondary mr-2 font-weight-bold q-number-badge">
                                                    {{ \App\model\LmsQuiz::toBengaliNumber($itemIndex + 1) }}
                                                </span>
                                                <span class="badge badge-info text-xs mr-2">{{ $item->getQuestionType() }}</span>
                                            </div>

                                            <div class="d-flex align-items-center gap-1">
                                                <!-- Move Up / Down Buttons for Accessibility & Touch Screens -->
                                                <div class="btn-group btn-group-xs mr-2">
                                                    <button type="button" class="btn btn-outline-secondary btn-xs" onclick="moveItemUp({{ $item->id }})" title="উপরে তুলুন">
                                                        <i class="fas fa-arrow-up"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary btn-xs" onclick="moveItemDown({{ $item->id }})" title="নিচে নামান">
                                                        <i class="fas fa-arrow-down"></i>
                                                    </button>
                                                </div>

                                                <!-- Marks Input -->
                                                <div class="input-group input-group-sm mr-2" style="width: 85px;">
                                                    <input type="number" step="0.5" class="form-control form-control-sm text-center item-marks-input" value="{{ $item->marks }}" onchange="updateItemMarks({{ $item->id }}, this.value)">
                                                    <div class="input-group-append"><span class="input-group-text text-xs p-1">নম্বর</span></div>
                                                </div>

                                                <!-- Delete button -->
                                                <button type="button" class="btn btn-xs btn-outline-danger" onclick="removeItemFromPaper({{ $item->id }})" title="প্রশ্নটি বাদ দিন">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Stimulus if present -->
                                        @if($item->getStimulus())
                                            <div class="alert alert-light border p-2 mb-2 text-xs text-muted font-italic">
                                                <strong>উদ্দীপক:</strong> {{ $item->getStimulus() }}
                                            </div>
                                        @endif

                                        <!-- Question Text -->
                                        <div class="font-weight-bold text-dark text-sm mb-2" style="line-height: 1.4;">
                                            {{ $item->getQuestionText() }}
                                        </div>

                                        <!-- Options Preview -->
                                        @php
                                            $opts = $item->getQuestionOptions();
                                        @endphp
                                        @if(!empty($opts))
                                            <div class="row row-cols-1 row-cols-sm-2 g-2">
                                                @foreach($opts as $optIdx => $o)
                                                    @php
                                                        $optText = is_array($o) ? (isset($o['option_text']) ? $o['option_text'] : '') : (isset($o->option_text) ? $o->option_text : '');
                                                        $isCorrect = is_array($o) ? !empty($o['is_correct']) : !empty($o->is_correct);
                                                    @endphp
                                                    <div class="col mb-1 text-xs">
                                                        <span class="badge {{ $isCorrect ? 'badge-success' : 'badge-light border' }} mr-1">
                                                            {{ \App\model\LmsQuestion::getBengaliOptionLetter($optIdx) }}
                                                        </span>
                                                        <span class="{{ $isCorrect ? 'text-success font-weight-bold' : 'text-dark' }}">{{ $optText }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <div class="text-center py-4 text-muted empty-drop-placeholder">
                                        <i class="fas fa-hand-point-down fa-2x mb-2 text-muted"></i>
                                        <p class="mb-0 text-xs">বাম পাশের প্রশ্ন লাইব্রেরি থেকে প্রশ্ন টেনে এনে (Drag & Drop) এখানে ড্রপ করুন অথবা '+' বাটনে ক্লিক করুন।</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5 text-muted empty-sections-placeholder" id="emptySectionsMsg">
                            <i class="fas fa-layer-group fa-3x text-muted mb-2"></i>
                            <h5 class="text-muted font-weight-bold">কোনো সেকশন তৈরি নেই!</h5>
                            <p class="text-xs text-muted mb-0">নিচের "নতুন সেকশন যুক্ত করুন" বাটনে ক্লিক করে প্রশ্নপত্রের সেকশন তৈরি করুন।</p>
                        </div>
                    @endforelse
                </div>

                <!-- Add Section CTA Button -->
                <div class="mt-4 text-center">
                    <button type="button" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#addSectionModal">
                        <i class="fas fa-folder-plus mr-1"></i> নতুন সেকশন যুক্ত করুন (যেমন: খ-বিভাগ: সংক্ষিপ্ত প্রশ্ন)
                    </button>
                </div>

            </div>
        </div>

        <!-- RIGHT PANEL: Paper Settings & Live Inspector -->
        <div class="builder-right-panel">
            
            <!-- Live Tally Card -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white py-2 px-3">
                    <h6 class="mb-0 font-weight-bold text-xs text-uppercase">
                        <i class="fas fa-calculator text-warning mr-1"></i> লাইভ হিসাব ও মূল্যায়ন
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-sm text-muted">মোট প্রশ্ন সংখ্যা:</span>
                        <span class="h5 font-weight-bold text-dark mb-0" id="liveQuestionsCount">
                            {{ \App\model\LmsQuiz::toBengaliNumber($totalQuestionsCount) }} টি
                        </span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-sm text-muted">বর্তমান অর্জিত মান:</span>
                        <span class="h5 font-weight-bold text-success mb-0" id="liveMarksTotal">
                            {{ \App\model\LmsQuiz::toBengaliNumber($calculatedMarks) }} নম্বর
                        </span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-sm text-muted">লক্ষ্যমাত্রা পূর্ণমান:</span>
                        <span class="h6 font-weight-bold text-primary mb-0">
                            {{ \App\model\LmsQuiz::toBengaliNumber($paper->total_marks) }} নম্বর
                        </span>
                    </div>

                    <!-- Marks Comparison Status -->
                    <div id="marksComparisonBox">
                        @if(abs($calculatedMarks - $paper->total_marks) > 0.01)
                            <div class="alert alert-warning p-2 text-xs mb-0">
                                <i class="fas fa-exclamation-triangle mr-1"></i> প্রশ্নপত্রের মোট মান ({{ $calculatedMarks }}) লক্ষ্যমাত্রার ({{ $paper->total_marks }}) সাথে মিলছে না।
                            </div>
                        @else
                            <div class="alert alert-success p-2 text-xs mb-0">
                                <i class="fas fa-check-circle mr-1"></i> পূর্ণমান পুরোপুরি সঠিক আছে!
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Paper Settings Form -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light py-2 px-3">
                    <h6 class="mb-0 font-weight-bold text-xs text-uppercase text-dark">
                        <i class="fas fa-cog text-secondary mr-1"></i> প্রশ্নপত্র সেটিংস
                    </h6>
                </div>
                <div class="card-body p-3">
                    <form action="{{ route('admin.question-papers.update-settings', $paper->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-2">
                            <label class="text-xs font-weight-bold">শিরোনাম:</label>
                            <input type="text" name="title" value="{{ $paper->title }}" class="form-control form-control-sm" required>
                        </div>

                        <div class="row">
                            <div class="col-6 mb-2">
                                <label class="text-xs font-weight-bold">সময় (মিনিট):</label>
                                <input type="number" name="duration_minutes" value="{{ $paper->duration_minutes }}" class="form-control form-control-sm" required>
                            </div>
                            <div class="col-6 mb-2">
                                <label class="text-xs font-weight-bold">পাস নম্বর:</label>
                                <input type="number" step="0.5" name="pass_marks" value="{{ $paper->pass_marks }}" class="form-control form-control-sm">
                            </div>
                        </div>

                        <div class="form-group mb-2">
                            <label class="text-xs font-weight-bold">স্ট্যাটাস:</label>
                            <select name="status" class="form-control form-control-sm custom-select">
                                <option value="draft" {{ $paper->status === 'draft' ? 'selected' : '' }}>ড্রাফট (Draft)</option>
                                <option value="review" {{ $paper->status === 'review' ? 'selected' : '' }}>পর্যালোচনাধীন (Review)</option>
                                <option value="approved" {{ $paper->status === 'approved' ? 'selected' : '' }}>অনুমোদিত (Approved)</option>
                                <option value="published" {{ $paper->status === 'published' ? 'selected' : '' }}>প্রকাশিত (Published)</option>
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label class="text-xs font-weight-bold">পরীক্ষার্থী নির্দেশাবলি:</label>
                            <textarea name="instructions" rows="2" class="form-control form-control-sm">{{ $paper->instructions }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-sm btn-outline-dark btn-block mt-2">
                            <i class="fas fa-check mr-1"></i> সেটিংস হালনাগাদ
                        </button>
                    </form>
                </div>
            </div>

            <!-- Online Publishing Action Card -->
            <!-- <div class="card shadow-sm border-0 bg-gradient-success text-white">
                <div class="card-body p-3">
                    <h6 class="font-weight-bold mb-1"><i class="fas fa-cloud-upload-alt mr-1"></i> অনলাইন পরীক্ষা পাবলিশ</h6>
                    <p class="text-xs text-white-50 mb-2">
                        এই প্রশ্নপত্রটি সরাসরি LMS অনলাইন কুইজ সিস্টেমে যুক্ত হবে যেখানে শিক্ষার্থীরা অনলাইন টাইমারসহ পরীক্ষা দিতে পারবে।
                    </p>
                    <form action="{{ route('admin.question-papers.publish-online', $paper->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-light btn-sm font-weight-bold text-success btn-block" onclick="return confirm('অনলাইন পরীক্ষা হিসেবে প্রকাশ করতে চান?')">
                            <i class="fas fa-globe mr-1"></i> এক-ক্লিকে অনলাইন কুইজ পাবলিশ
                        </button>
                    </form>
                </div>
            </div> -->

        </div>
    </div>

    <!-- Add Section Modal (Zero Reload via AJAX) -->
    <div class="modal fade" id="addSectionModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content shadow border-0">
                <form id="ajaxAddSectionForm">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title font-weight-bold">
                            <i class="fas fa-folder-plus mr-1"></i> নতুন সেকশন যোগ করুন
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label class="text-xs font-weight-bold">সেকশন কোড: <span class="text-danger">*</span></label>
                            <input type="text" id="newSecCode" class="form-control" placeholder="যেমন: B, C, খ, গ" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="text-xs font-weight-bold">সেকশনের শিরোনাম: <span class="text-danger">*</span></label>
                            <input type="text" id="newSecTitle" class="form-control" placeholder="যেমন: Section B: Short Questions (সংক্ষিপ্ত প্রশ্নাবলী)" required>
                        </div>
                        <div class="form-group mb-2">
                            <label class="text-xs font-weight-bold">প্রতি প্রশ্নের ডিফল্ট মান:</label>
                            <input type="number" step="0.5" id="newSecMarks" class="form-control" value="2.0">
                        </div>
                        <div class="form-group mb-0">
                            <label class="text-xs font-weight-bold">সেকশন নির্দেশাবলি:</label>
                            <textarea id="newSecInstructions" rows="2" class="form-control" placeholder="যেমন: যেকোনো ৫টি প্রশ্নের উত্তর দাও।"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল</button>
                        <button type="button" class="btn btn-primary font-weight-bold" onclick="submitAddSectionAJAX()">
                            <i class="fas fa-plus mr-1"></i> সেকশন তৈরি করুন
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Auto-Pick / Random Questions Modal (Zero Reload via AJAX) -->
    <div class="modal fade" id="autoPickModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content shadow border-0">
                <form id="ajaxAutoPickForm">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title font-weight-bold">
                            <i class="fas fa-magic mr-1"></i> অটো প্রশ্ন বাছাই (Rule-Based Generator)
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label class="text-xs font-weight-bold">কোন সেকশনে যুক্ত হবে: <span class="text-danger">*</span></label>
                            <select id="autoPickSectionSelect" class="form-control custom-select" required>
                                @foreach($paper->sections as $sec)
                                    <option value="{{ $sec->id }}">{{ $sec->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label class="text-xs font-weight-bold">ক্যাটাগরি:</label>
                                <select id="autoPickCategory" class="form-control custom-select">
                                    <option value="">-- যেকোনো ক্যাটাগরি --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}">{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mb-2">
                                <label class="text-xs font-weight-bold">অধ্যায়:</label>
                                <select id="autoPickChapter" class="form-control custom-select">
                                    <option value="">-- যেকোনো অধ্যায় --</option>
                                    @foreach($chapters as $ch)
                                        <option value="{{ $ch }}">{{ $ch }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label class="text-xs font-weight-bold">কঠিন্যতা:</label>
                                <select id="autoPickDifficulty" class="form-control custom-select">
                                    <option value="">-- যেকোনো লেভেল --</option>
                                    <option value="easy">সহজ (Easy)</option>
                                    <option value="medium">মাঝারি (Medium)</option>
                                    <option value="hard">কঠিন (Hard)</option>
                                </select>
                            </div>
                            <div class="col-6 mb-2">
                                <label class="text-xs font-weight-bold">প্রশ্নের সংখ্যা: <span class="text-danger">*</span></label>
                                <input type="number" id="autoPickCount" class="form-control" value="10" min="1" max="100" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">বাতিল</button>
                        <button type="button" class="btn btn-info font-weight-bold" onclick="submitAutoPickAJAX()">
                            <i class="fas fa-magic mr-1"></i> স্বয়ংক্রিয়ভাবে নির্বাচন করুন
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Core Drag-and-Drop & Zero-Reload Reactive Scripts -->
    <script>
        var paperId = {{ $paper->id }};
        var csrfToken = '{{ csrf_token() }}';
        var activeDraggedQuestionId = null;
        var activeDraggedCardItemId = null;
        var bengaliDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        var targetTotalMarks = {{ (float)$paper->total_marks }};

        // Utility: Toast Notification
        function showToast(message, type) {
            type = type || 'success';
            var container = document.getElementById('builderToastContainer');
            var toast = document.createElement('div');
            toast.className = 'builder-toast toast-' + type;
            var icon = type === 'success' ? 'fa-check-circle' : (type === 'danger' ? 'fa-exclamation-circle' : 'fa-info-circle');
            toast.innerHTML = '<span><i class="fas ' + icon + ' mr-2"></i>' + message + '</span><i class="fas fa-times text-white-50 cursor-pointer" onclick="this.parentElement.remove()"></i>';
            container.appendChild(toast);
            setTimeout(function() {
                toast.style.opacity = '0';
                setTimeout(function() { toast.remove(); }, 300);
            }, 3500);
        }

        // Utility: Convert to Bengali Number
        function toBengaliNum(num) {
            return num.toString().split('').map(function(ch) {
                if (ch === '.') return '.';
                var d = parseInt(ch);
                return isNaN(d) ? ch : bengaliDigits[d];
            }).join('');
        }

        // 1. Drag from Left Library Panel
        function onDragStartLibrary(e, questionId) {
            activeDraggedQuestionId = questionId;
            activeDraggedCardItemId = null;
            e.dataTransfer.setData('text/plain', 'library:' + questionId);
            e.dataTransfer.effectAllowed = 'copy';
        }

        // 2. Drag Question Card within Canvas
        function onDragStartCard(e, itemId) {
            activeDraggedCardItemId = itemId;
            activeDraggedQuestionId = null;
            e.dataTransfer.setData('text/plain', 'card:' + itemId);
            e.dataTransfer.effectAllowed = 'move';
        }

        function onDragOverZone(e) {
            e.preventDefault();
            e.currentTarget.classList.add('drag-over');
        }

        function onDragLeaveZone(e) {
            e.currentTarget.classList.remove('drag-over');
        }

        function onDropZone(e, sectionId) {
            e.preventDefault();
            e.currentTarget.classList.remove('drag-over');
            var rawData = e.dataTransfer.getData('text/plain');

            if (rawData && rawData.startsWith('card:')) {
                // Reordering an existing card between sections
                var itemId = rawData.replace('card:', '');
                var card = document.getElementById('item_card_' + itemId);
                var dropzone = document.getElementById('dropzone_' + sectionId);
                if (card && dropzone) {
                    var emptyPlaceholder = dropzone.querySelector('.empty-drop-placeholder');
                    if (emptyPlaceholder) emptyPlaceholder.remove();
                    dropzone.appendChild(card);
                    updateQuestionNumbers();
                    savePaperDraft();
                    showToast('প্রশ্নটি নতুন সেকশনে স্থানান্তরিত হয়েছে!', 'info');
                }
            } else {
                // Dropping from library
                var qId = activeDraggedQuestionId || (rawData ? rawData.replace('library:', '') : null);
                if (qId) {
                    addQuestionToSection(qId, sectionId);
                }
            }
        }

        // 3. Add Question to section via AJAX (Zero Full Page Reload)
        function addQuestionToSection(questionId, sectionId, allowDuplicate) {
            fetch('/admin/question-papers/' + paperId + '/add-item', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    question_id: questionId,
                    section_id: sectionId,
                    allow_duplicate: allowDuplicate ? 1 : 0
                })
            })
            .then(function(r) { return r.json(); })
            .then(function(res) {
                if (res.success) {
                    var dropzone = document.getElementById('dropzone_' + res.section_id);
                    if (dropzone) {
                        // Remove empty placeholder
                        var placeholder = dropzone.querySelector('.empty-drop-placeholder');
                        if (placeholder) placeholder.remove();

                        // Build and append card element dynamically
                        var cardHtml = buildQuestionCardHtml(res.item);
                        var tempWrapper = document.createElement('div');
                        tempWrapper.innerHTML = cardHtml;
                        var newCard = tempWrapper.firstElementChild;
                        dropzone.appendChild(newCard);

                        // Trigger pulse highlight
                        newCard.classList.add('just-added');

                        // Update sequential Bengali question numbers
                        updateQuestionNumbers();

                        // Update Live Tally
                        updateLiveStats(res.total_questions, res.total_marks);

                        showToast(res.message, 'success');
                    }
                } else if (res.is_duplicate) {
                    if (confirm(res.message)) {
                        addQuestionToSection(questionId, sectionId, true);
                    }
                } else {
                    showToast(res.message || 'ত্রুটি ঘটেছে', 'danger');
                }
            })
            .catch(function(err) {
                showToast('প্রশ্ন যোগ করতে ব্যর্থ হয়েছে: ' + err, 'danger');
            });
        }

        function addQuestionToActiveSection(questionId) {
            var firstSection = document.querySelector('.paper-section-block');
            var sectionId = firstSection ? firstSection.getAttribute('data-section-id') : null;
            if (!sectionId) {
                showToast('অনুগ্রহ করে প্রথমে একটি সেকশন তৈরি করুন।', 'danger');
                return;
            }
            addQuestionToSection(questionId, sectionId);
        }

        // 4. Construct Question Card DOM String
        function buildQuestionCardHtml(item) {
            var stimulusHtml = item.stimulus ? '<div class="alert alert-light border p-2 mb-2 text-xs text-muted font-italic"><strong>উদ্দীপক:</strong> ' + escapeHtml(item.stimulus) + '</div>' : '';

            var optionsHtml = '';
            if (item.options && item.options.length > 0) {
                optionsHtml = '<div class="row row-cols-1 row-cols-sm-2 g-2">';
                item.options.forEach(function(o) {
                    var cls = o.is_correct ? 'text-success font-weight-bold' : 'text-dark';
                    var badgeCls = o.is_correct ? 'badge-success' : 'badge-light border';
                    optionsHtml += '<div class="col mb-1 text-xs"><span class="badge ' + badgeCls + ' mr-1">' + o.letter + '</span><span class="' + cls + '">' + escapeHtml(o.text) + '</span></div>';
                });
                optionsHtml += '</div>';
            }

            return `
                <div class="canvas-question-card" 
                     id="item_card_${item.id}" 
                     data-item-id="${item.id}" 
                     data-question-id="${item.question_id}"
                     draggable="true"
                     ondragstart="onDragStartCard(event, ${item.id})">
                    
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-grip-vertical drag-handle mr-2" title="ড্র্যাগ করে সাজান"></i>
                            <span class="badge badge-secondary mr-2 font-weight-bold q-number-badge">১</span>
                            <span class="badge badge-info text-xs mr-2">${item.question_type}</span>
                        </div>

                        <div class="d-flex align-items-center gap-1">
                            <div class="btn-group btn-group-xs mr-2">
                                <button type="button" class="btn btn-outline-secondary btn-xs" onclick="moveItemUp(${item.id})" title="উপরে তুলুন">
                                    <i class="fas fa-arrow-up"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-xs" onclick="moveItemDown(${item.id})" title="নিচে নামান">
                                    <i class="fas fa-arrow-down"></i>
                                </button>
                            </div>

                            <div class="input-group input-group-sm mr-2" style="width: 85px;">
                                <input type="number" step="0.5" class="form-control form-control-sm text-center item-marks-input" value="${item.marks}" onchange="updateItemMarks(${item.id}, this.value)">
                                <div class="input-group-append"><span class="input-group-text text-xs p-1">নম্বর</span></div>
                            </div>

                            <button type="button" class="btn btn-xs btn-outline-danger" onclick="removeItemFromPaper(${item.id})" title="প্রশ্নটি বাদ দিন">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    ${stimulusHtml}

                    <div class="font-weight-bold text-dark text-sm mb-2" style="line-height: 1.4;">
                        ${escapeHtml(item.question_text)}
                    </div>

                    ${optionsHtml}
                </div>
            `;
        }

        function escapeHtml(text) {
            if (!text) return '';
            var div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // 5. Remove Item via AJAX (Zero Full Page Reload)
        function removeItemFromPaper(itemId) {
            if (!confirm('আপনি কি এই প্রশ্নটি প্রশ্নপত্র থেকে বাদ দিতে চান?')) return;

            fetch('/admin/question-papers/' + paperId + '/items/' + itemId, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrfToken }
            })
            .then(function(r) { return r.json(); })
            .then(function(res) {
                if (res.success) {
                    var el = document.getElementById('item_card_' + itemId);
                    if (el) {
                        var dropzone = el.parentElement;
                        el.style.opacity = '0';
                        el.style.transform = 'scale(0.9)';
                        setTimeout(function() {
                            el.remove();
                            // If dropzone now empty, show placeholder
                            if (dropzone && dropzone.querySelectorAll('.canvas-question-card').length === 0) {
                                dropzone.innerHTML = '<div class="text-center py-4 text-muted empty-drop-placeholder"><i class="fas fa-hand-point-down fa-2x mb-2 text-muted"></i><p class="mb-0 text-xs">বাম পাশের প্রশ্ন লাইব্রেরি থেকে প্রশ্ন টেনে এনে (Drag & Drop) এখানে ড্রপ করুন অথবা \'+\' বাটনে ক্লিক করুন।</p></div>';
                            }
                            updateQuestionNumbers();
                            updateLiveStats(res.total_questions, res.total_marks);
                            showToast(res.message, 'info');
                        }, 250);
                    }
                }
            })
            .catch(function(err) {
                showToast('প্রশ্ন অপসরণে ত্রুটি: ' + err, 'danger');
            });
        }

        // 6. Move Item Up / Down (Instant DOM reorder)
        function moveItemUp(itemId) {
            var card = document.getElementById('item_card_' + itemId);
            if (card && card.previousElementSibling && card.previousElementSibling.classList.contains('canvas-question-card')) {
                card.parentNode.insertBefore(card, card.previousElementSibling);
                updateQuestionNumbers();
                savePaperDraft();
            }
        }

        function moveItemDown(itemId) {
            var card = document.getElementById('item_card_' + itemId);
            if (card && card.nextElementSibling && card.nextElementSibling.classList.contains('canvas-question-card')) {
                card.parentNode.insertBefore(card.nextElementSibling, card);
                updateQuestionNumbers();
                savePaperDraft();
            }
        }

        // 7. Sequentially Renumber All Questions Across Sections
        function updateQuestionNumbers() {
            var badges = document.querySelectorAll('.q-number-badge');
            badges.forEach(function(b, idx) {
                b.innerText = toBengaliNum(idx + 1);
            });

            // Update section items count badge
            var sections = document.querySelectorAll('.paper-section-block');
            sections.forEach(function(sec) {
                var secId = sec.getAttribute('data-section-id');
                var count = sec.querySelectorAll('.canvas-question-card').length;
                var badge = document.getElementById('sec_count_' + secId);
                if (badge) badge.innerText = toBengaliNum(count) + ' টি প্রশ্ন';
            });
        }

        function updateItemMarks(itemId, val) {
            savePaperDraft();
        }

        // 8. Update Live Stats Tally & Marks Warning
        function updateLiveStats(totalQuestions, totalMarks) {
            if (typeof totalQuestions === 'undefined' || typeof totalMarks === 'undefined') {
                var cards = document.querySelectorAll('.canvas-question-card');
                totalQuestions = cards.length;
                totalMarks = 0;
                cards.forEach(function(c) {
                    var inp = c.querySelector('.item-marks-input');
                    if (inp) totalMarks += parseFloat(inp.value) || 0;
                });
            }

            var countEl = document.getElementById('liveQuestionsCount');
            var marksEl = document.getElementById('liveMarksTotal');
            if (countEl) countEl.innerText = toBengaliNum(totalQuestions) + ' টি';
            if (marksEl) marksEl.innerText = toBengaliNum(totalMarks.toFixed(1)) + ' নম্বর';

            var diff = Math.abs(totalMarks - targetTotalMarks);
            var box = document.getElementById('marksComparisonBox');
            if (box) {
                if (diff > 0.01) {
                    box.innerHTML = '<div class="alert alert-warning p-2 text-xs mb-0"><i class="fas fa-exclamation-triangle mr-1"></i> প্রশ্নপত্রের মোট মান (' + totalMarks.toFixed(1) + ') লক্ষ্যমাত্রার (' + targetTotalMarks + ') সাথে মিলছে না।</div>';
                } else {
                    box.innerHTML = '<div class="alert alert-success p-2 text-xs mb-0"><i class="fas fa-check-circle mr-1"></i> পূর্ণমান পুরোপুরি সঠিক আছে!</div>';
                }
            }
        }

        // 9. Save Draft via AJAX
        function savePaperDraft(manualClick) {
            var sectionsData = [];
            var sectionBlocks = document.querySelectorAll('.paper-section-block');

            sectionBlocks.forEach(function(secEl) {
                var secId = secEl.getAttribute('data-section-id');
                var itemCards = secEl.querySelectorAll('.canvas-question-card');
                var itemsData = [];

                itemCards.forEach(function(cardEl) {
                    var itemId = cardEl.getAttribute('data-item-id');
                    var marksInput = cardEl.querySelector('.item-marks-input');
                    itemsData.push({
                        id: itemId,
                        marks: marksInput ? parseFloat(marksInput.value) : 1.0
                    });
                });

                sectionsData.push({
                    id: secId,
                    items: itemsData
                });
            });

            // LocalStorage backup
            localStorage.setItem('paper_draft_' + paperId, JSON.stringify(sectionsData));

            fetch('/admin/question-papers/' + paperId + '/save-draft', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ sections: sectionsData })
            })
            .then(function(r) { return r.json(); })
            .then(function(res) {
                if (res.success) {
                    var ind = document.getElementById('autosaveIndicator');
                    ind.innerHTML = '<i class="fas fa-check-circle text-success mr-1"></i> সংরক্ষিত: ' + res.updated_at;
                    updateLiveStats(res.total_questions, res.total_marks);
                    if (manualClick) {
                        showToast('প্রশ্নপত্রের ড্রাফট সফলভাবে সংরক্ষিত হয়েছে!', 'success');
                    }
                }
            });
        }

        // 10. Instant AJAX Library Search & Filtering
        var libSearchTimer = null;
        function debounceLibrarySearch() {
            clearTimeout(libSearchTimer);
            libSearchTimer = setTimeout(loadLibraryQuestionsAJAX, 350);
        }

        function loadLibraryQuestionsAJAX() {
            var search = document.getElementById('libSearchInput').value;
            var cat = document.getElementById('libCategoryFilter').value;
            var diff = document.getElementById('libDiffFilter').value;

            var params = new URLSearchParams();
            if (search) params.append('search', search);
            if (cat) params.append('category', cat);
            if (diff) params.append('difficulty', diff);

            var container = document.getElementById('libraryScrollContainer');
            container.innerHTML = '<div class="text-center py-4 text-muted"><i class="fas fa-spinner fa-spin fa-2x"></i><p class="text-xs mt-2">লোড হচ্ছে...</p></div>';

            fetch('/admin/question-papers/' + paperId + '/library-questions?' + params.toString())
                .then(function(r) { return r.json(); })
                .then(function(res) {
                    if (res.success) {
                        var badge = document.getElementById('libTotalCountBadge');
                        if (badge) badge.innerText = res.total + 'টি প্রশ্ন';

                        if (res.questions.length === 0) {
                            container.innerHTML = '<div class="text-center py-4 text-muted text-xs"><i class="fas fa-search fa-2x mb-2 text-muted"></i><p>কোনো প্রশ্ন পাওয়া যায়নি।</p></div>';
                            return;
                        }

                        var html = '';
                        res.questions.forEach(function(lq) {
                            var stim = lq.stimulus ? '<div class="text-xs text-muted font-italic mb-1 text-truncate"><strong>উদ্দীপক:</strong> ' + escapeHtml(lq.stimulus) + '</div>' : '';
                            html += `
                                <div class="draggable-library-card p-2 mb-2" 
                                     draggable="true" 
                                     ondragstart="onDragStartLibrary(event, ${lq.id})"
                                     data-question-id="${lq.id}">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <div>
                                            <span class="badge badge-light border text-muted">#${lq.id}</span>
                                            <span class="badge badge-info text-xs">${lq.question_type}</span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <span class="badge badge-pill badge-success mr-2 font-weight-bold">
                                                ${lq.marks_bn}
                                            </span>
                                            <button type="button" class="btn btn-xs btn-outline-primary" onclick="addQuestionToActiveSection(${lq.id})" title="প্রশ্নপত্রে যোগ করুন">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    ${stim}

                                    <div class="font-weight-bold text-dark text-xs mb-1" style="line-height: 1.3;">
                                        ${escapeHtml(lq.question_text)}
                                    </div>

                                    <div class="text-xs text-muted">
                                        ${lq.options_count}টি অপশন | <span class="text-info">${lq.category}</span>
                                    </div>
                                </div>
                            `;
                        });
                        container.innerHTML = html;
                    }
                })
                .catch(function(err) {
                    container.innerHTML = '<div class="alert alert-danger text-xs">লোড ব্যর্থ: ' + err + '</div>';
                });
        }

        // 11. Add Section via AJAX (Zero Full Page Reload)
        function submitAddSectionAJAX() {
            var code = document.getElementById('newSecCode').value;
            var title = document.getElementById('newSecTitle').value;
            var marks = document.getElementById('newSecMarks').value;
            var instructions = document.getElementById('newSecInstructions').value;

            if (!code || !title) {
                alert('সেকশন কোড এবং শিরোনাম পূরণ করুন');
                return;
            }

            fetch('/admin/question-papers/' + paperId + '/sections', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    section_code: code,
                    title: title,
                    marks_per_question: marks,
                    instructions: instructions
                })
            })
            .then(function(r) { return r.json(); })
            .then(function(res) {
                if (res.success) {
                    $('#addSectionModal').modal('hide');
                    document.getElementById('ajaxAddSectionForm').reset();

                    var sec = res.section;
                    var container = document.getElementById('paperSectionsContainer');

                    // Remove empty sections placeholder if present
                    var emptyPlaceholder = container.querySelector('.empty-sections-placeholder') || document.getElementById('emptySectionsMsg');
                    if (emptyPlaceholder) {
                        emptyPlaceholder.remove();
                    }

                    var secBlock = document.createElement('div');
                    secBlock.className = 'paper-section-block mb-4';
                    secBlock.id = 'sec_block_' + sec.id;
                    secBlock.setAttribute('data-section-id', sec.id);

                    var instHtml = sec.instructions ? '<div class="text-xs text-muted font-italic mb-2 pl-1">' + escapeHtml(sec.instructions) + '</div>' : '';

                    secBlock.innerHTML = `
                        <div class="d-flex justify-content-between align-items-center bg-light p-2.5 rounded border mb-2">
                            <div class="d-flex align-items-center">
                                <span class="badge badge-dark mr-2 font-weight-bold">${escapeHtml(sec.section_code)}</span>
                                <h6 class="mb-0 font-weight-bold text-dark">${escapeHtml(sec.title)}</h6>
                            </div>
                            <div class="d-flex align-items-center">
                                <span class="badge badge-pill badge-primary mr-2 sec-item-count" id="sec_count_${sec.id}">০ টি প্রশ্ন</span>
                                <button type="button" class="btn btn-xs btn-outline-danger" onclick="deleteSectionAJAX(${sec.id})" title="সেকশন মুছুন">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                        ${instHtml}
                        <div class="section-dropzone" 
                             ondragover="onDragOverZone(event)" 
                             ondragleave="onDragLeaveZone(event)" 
                             ondrop="onDropZone(event, ${sec.id})" 
                             id="dropzone_${sec.id}">
                            <div class="text-center py-4 text-muted empty-drop-placeholder">
                                <i class="fas fa-hand-point-down fa-2x mb-2 text-muted"></i>
                                <p class="mb-0 text-xs">বাম পাশের প্রশ্ন লাইব্রেরি থেকে প্রশ্ন টেনে এনে (Drag & Drop) এখানে ড্রপ করুন অথবা '+' বাটনে ক্লিক করুন।</p>
                            </div>
                        </div>
                    `;

                    container.appendChild(secBlock);

                    // Also add to autoPick dropdown
                    var select = document.getElementById('autoPickSectionSelect');
                    if (select) {
                        var opt = document.createElement('option');
                        opt.value = sec.id;
                        opt.innerText = sec.title;
                        select.appendChild(opt);
                    }

                    showToast(res.message, 'success');
                } else {
                    alert(res.message || 'ত্রুটি ঘটেছে');
                }
            })
            .catch(function(err) {
                alert('সেকশন যোগ করতে ব্যর্থ: ' + err);
            });
        }

        // 12. Delete Section via AJAX (Zero Full Page Reload)
        function deleteSectionAJAX(sectionId) {
            if (!confirm('আপনি কি নিশ্চিতভাবে এই সেকশন ও এর অন্তর্গত সকল প্রশ্ন মুছে ফেলতে চান?')) return;

            fetch('/admin/question-papers/' + paperId + '/sections/' + sectionId, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            })
            .then(function(r) { return r.json(); })
            .then(function(res) {
                if (res.success) {
                    var secBlock = document.getElementById('sec_block_' + sectionId);
                    if (secBlock) {
                        secBlock.style.opacity = '0';
                        setTimeout(function() {
                            secBlock.remove();
                            var container = document.getElementById('paperSectionsContainer');
                            if (container && container.querySelectorAll('.paper-section-block').length === 0) {
                                container.innerHTML = `
                                    <div class="text-center py-5 text-muted empty-sections-placeholder" id="emptySectionsMsg">
                                        <i class="fas fa-layer-group fa-3x text-muted mb-2"></i>
                                        <h5 class="text-muted font-weight-bold">কোনো সেকশন তৈরি নেই!</h5>
                                        <p class="text-xs text-muted mb-0">নিচের "নতুন সেকশন যুক্ত করুন" বাটনে ক্লিক করে প্রশ্নপত্রের সেকশন তৈরি করুন।</p>
                                    </div>
                                `;
                            }
                            updateQuestionNumbers();
                            updateLiveStats(res.total_questions, res.total_marks);
                            showToast(res.message, 'info');
                        }, 250);
                    }
                }
            })
            .catch(function(err) {
                alert('সেকশন মুছতে সমস্যা হয়েছে: ' + err);
            });
        }

        // 13. Auto-Pick / Random Questions via AJAX (Zero Full Page Reload)
        function submitAutoPickAJAX() {
            var sectionId = document.getElementById('autoPickSectionSelect').value;
            var category = document.getElementById('autoPickCategory').value;
            var chapter = document.getElementById('autoPickChapter').value;
            var diff = document.getElementById('autoPickDifficulty').value;
            var count = document.getElementById('autoPickCount').value;

            fetch('/admin/question-papers/' + paperId + '/auto-select', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    section_id: sectionId,
                    category: category,
                    chapter: chapter,
                    difficulty: diff,
                    count: count
                })
            })
            .then(function(r) { return r.json(); })
            .then(function(res) {
                if (res.success) {
                    $('#autoPickModal').modal('hide');
                    var dropzone = document.getElementById('dropzone_' + res.section_id);
                    if (dropzone) {
                        var placeholder = dropzone.querySelector('.empty-drop-placeholder');
                        if (placeholder) placeholder.remove();

                        res.items.forEach(function(item) {
                            var cardHtml = buildQuestionCardHtml(item);
                            var temp = document.createElement('div');
                            temp.innerHTML = cardHtml;
                            var newCard = temp.firstElementChild;
                            dropzone.appendChild(newCard);
                            newCard.classList.add('just-added');
                        });

                        updateQuestionNumbers();
                        updateLiveStats(res.total_questions, res.total_marks);
                        showToast(res.message, 'success');
                    }
                } else {
                    alert(res.message || 'কোনো উপযুক্ত প্রশ্ন পাওয়া যায়নি');
                }
            })
            .catch(function(err) {
                alert('অটো সিলেকশনে ত্রুটি: ' + err);
            });
        }

        // Periodic Background Auto-Save (Every 30 seconds)
        setInterval(function() {
            savePaperDraft(false);
        }, 30000);
    </script>
@endsection
