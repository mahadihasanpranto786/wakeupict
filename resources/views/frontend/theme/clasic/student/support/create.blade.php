@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Open Support Ticket — Wake Up ICT')
@section('page_title', 'Open Support Ticket')
@section('page_crumb', 'New Help Request')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Header -->
    <div class="flex items-center justify-between pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-plus-circle text-brand-primary"></i>
                <span>Open New Support Ticket</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Describe your inquiry, issue, or question. Our academic and technical advisors respond within hours.
            </p>
        </div>
        <a href="{{ route('student.support.index') }}" class="px-3.5 py-1.5 rounded-xl bg-slate-900 border border-slate-800 text-xs text-slate-300 hover:text-white transition-colors flex items-center gap-1.5">
            <i class="fa fa-arrow-left"></i>
            <span>Back to Tickets</span>
        </a>
    </div>

    <!-- Error Alerts -->
    @if($errors->any())
        <div class="p-4 rounded-2xl bg-rose-500/10 border border-rose-500/30 text-rose-300 text-xs space-y-1">
            <div class="font-bold flex items-center gap-2">
                <i class="fa fa-exclamation-circle"></i> Please resolve the following errors:
            </div>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Container -->
    <div class="student-card rounded-3xl bg-slate-900/90 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl shadow-2xl">
        <form action="{{ route('student.support.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Subject -->
            <div class="space-y-2">
                <label for="subject" class="block text-xs font-mono uppercase text-slate-300 tracking-wider">
                    Subject / Title <span class="text-rose-400">*</span>
                </label>
                <input type="text" name="subject" id="subject" required value="{{ old('subject') }}"
                       placeholder="e.g. Issue accessing lesson 3 video, or Fee verification question"
                       class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 focus:border-brand-primary text-white text-xs sm:text-sm focus:outline-none focus:ring-1 focus:ring-brand-primary transition-all">
            </div>

            <!-- Grid: Category & Priority -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Category -->
                <div class="space-y-2">
                    <label for="category" class="block text-xs font-mono uppercase text-slate-300 tracking-wider">
                        Category <span class="text-rose-400">*</span>
                    </label>
                    <select name="category" id="category" required
                            class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 focus:border-brand-primary text-white text-xs sm:text-sm focus:outline-none focus:ring-1 focus:ring-brand-primary transition-all">
                        <option value="academic" {{ old('category') === 'academic' ? 'selected' : '' }}>Academic / Course Curriculum</option>
                        <option value="technical" {{ old('category') === 'technical' ? 'selected' : '' }}>Technical / Platform Issue</option>
                        <option value="fees_payment" {{ old('category') === 'fees_payment' ? 'selected' : '' }}>Fees &amp; Payment Verification</option>
                        <option value="exam_quiz" {{ old('category') === 'exam_quiz' ? 'selected' : '' }}>Exams &amp; Quizzes</option>
                        <option value="general" {{ old('category') === 'general' ? 'selected' : '' }}>General Query</option>
                    </select>
                </div>

                <!-- Priority -->
                <div class="space-y-2">
                    <label for="priority" class="block text-xs font-mono uppercase text-slate-300 tracking-wider">
                        Priority Level <span class="text-rose-400">*</span>
                    </label>
                    <select name="priority" id="priority" required
                            class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 focus:border-brand-primary text-white text-xs sm:text-sm focus:outline-none focus:ring-1 focus:ring-brand-primary transition-all">
                        <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Low (General inquiry)</option>
                        <option value="medium" {{ old('priority', 'medium') === 'medium' ? 'selected' : '' }}>Medium (Standard support)</option>
                        <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>High (Important blocker)</option>
                        <option value="urgent" {{ old('priority') === 'urgent' ? 'selected' : '' }}>Urgent (Critical issue)</option>
                    </select>
                </div>
            </div>

            <!-- Detailed Message -->
            <div class="space-y-2">
                <label for="message" class="block text-xs font-mono uppercase text-slate-300 tracking-wider">
                    Detailed Message <span class="text-rose-400">*</span>
                </label>
                <textarea name="message" id="message" rows="6" required minlength="10"
                          placeholder="Provide all relevant details, error messages, or course names to help us assist you faster..."
                          class="w-full px-4 py-3 rounded-xl bg-slate-950/80 border border-slate-800 focus:border-brand-primary text-white text-xs sm:text-sm focus:outline-none focus:ring-1 focus:ring-brand-primary transition-all">{{ old('message') }}</textarea>
                <span class="text-[11px] text-slate-500">Minimum 10 characters.</span>
            </div>

            <!-- Attachment File -->
            <div class="space-y-2">
                <label for="attachment" class="block text-xs font-mono uppercase text-slate-300 tracking-wider">
                    Attach Screenshot / Document (Optional)
                </label>
                <input type="file" name="attachment" id="attachment"
                       class="w-full px-4 py-2.5 rounded-xl bg-slate-950/80 border border-slate-800 file:mr-4 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-brand-primary file:text-slate-950 hover:file:bg-brand-accent text-xs text-slate-300 focus:outline-none">
                <span class="text-[11px] text-slate-500">Supported formats: PDF, PNG, JPG, DOCX, ZIP (Max: 5MB).</span>
            </div>

            <!-- Submit Button -->
            <div class="pt-4 border-t border-slate-800 flex justify-end">
                <button type="submit" class="w-full sm:w-auto px-8 py-3 rounded-xl font-bold text-xs uppercase tracking-wider bg-brand-primary hover:bg-brand-accent text-slate-950 transition-all shadow-glow-emerald flex items-center justify-center gap-2">
                    <i class="fa fa-paper-plane"></i>
                    <span>Submit Support Ticket</span>
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
