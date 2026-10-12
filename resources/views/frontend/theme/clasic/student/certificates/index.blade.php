@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Certificates & Professional Achievements — Wake Up ICT')
@section('page_title', 'Certificates & Achievements')
@section('page_crumb', 'Official Certifications')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-certificate text-brand-primary"></i>
                <span>Official Certificates &amp; Credentials</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Verifiable graduation certificates awarded upon successful curriculum mastery and assessment completion.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3.5 py-1.5 rounded-xl bg-slate-800/80 border border-slate-700 text-slate-300 font-mono text-xs">
                Earned: <strong class="text-brand-primary">{{ $certificates->count() }}</strong>
            </span>
        </div>
    </div>

    <!-- Issued Certificates Gallery -->
    @if($certificates->count() > 0)
        <div class="space-y-4">
            <h2 class="text-base font-bold text-white flex items-center gap-2">
                <i class="fa fa-trophy text-amber-400"></i>
                <span>Earned Credentials</span>
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($certificates as $cert)
                    <div class="student-card rounded-3xl bg-slate-900/90 border border-amber-500/30 p-6 flex flex-col justify-between hover:border-amber-500/60 transition-all group backdrop-blur-xl space-y-5 shadow-2xl relative overflow-hidden">
                        <div class="absolute -right-12 -top-12 w-32 h-32 bg-amber-500/10 rounded-full blur-2xl pointer-events-none"></div>

                        <div class="space-y-3 relative z-10">
                            <!-- Certificate Header Badges -->
                            <div class="flex items-center justify-between gap-2">
                                <span class="px-2.5 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 font-mono text-[10px] font-bold uppercase tracking-wider">
                                    Official Credential
                                </span>
                                <span class="px-2 py-0.5 rounded bg-brand-primary/10 text-brand-primary font-mono text-[10px] font-bold">
                                    Grade: {{ $cert->grade ?: 'A+' }}
                                </span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-base font-bold text-white group-hover:text-amber-400 transition-colors line-clamp-2 leading-snug">
                                {{ $cert->course ? $cert->course->course_title : $cert->title }}
                            </h3>

                            <!-- Certificate Details -->
                            <div class="p-3.5 rounded-2xl bg-slate-950/70 border border-slate-800 space-y-1.5 text-xs font-mono">
                                <div class="flex justify-between text-slate-400">
                                    <span>Certificate Code:</span>
                                    <strong class="text-brand-primary select-all">{{ $cert->certificate_code }}</strong>
                                </div>
                                <div class="flex justify-between text-slate-400">
                                    <span>Issue Date:</span>
                                    <span class="text-white">{{ $cert->issue_date->format('M d, Y') }}</span>
                                </div>
                                <div class="flex justify-between text-slate-400">
                                    <span>Verification:</span>
                                    <span class="text-emerald-400 font-bold"><i class="fa fa-check-circle"></i> Authenticated</span>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="pt-4 border-t border-slate-800/80 relative z-10">
                            <a href="{{ route('student.certificates.view', $cert->certificate_code) }}" target="_blank" class="w-full justify-center px-4 py-3 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-black text-xs uppercase tracking-wider transition-all shadow-md flex items-center gap-2">
                                <i class="fa fa-eye"></i>
                                <span>View &amp; Print Certificate</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Offline Course Completion & Certificate Status Tracker -->
    <div class="space-y-4 pt-4">
        <div class="flex items-center justify-between">
            <h2 class="text-base font-bold text-white flex items-center gap-2">
                <i class="fa fa-university text-brand-primary"></i>
                <span>Campus Courses &amp; Certification Status</span>
            </h2>
            <span class="text-xs text-slate-400 font-mono hidden sm:inline-block">
                <i class="fa fa-info-circle text-brand-cyan mr-1"></i> অফলাইন ক্লাস ও চূড়ান্ত মূল্যায়নের পর অ্যাডমিন কর্তৃক ইস্যুকৃত
            </span>
        </div>

        @if(!empty($eligibilityList))
            <div class="space-y-4">
                @foreach($eligibilityList as $item)
                    @php
                        $c = $item['course'];
                        $prog = $item['progress_percentage'];
                        $isPub = $item['is_published'];
                        $isPending = $item['is_pending_review'];
                        $cert = $item['certificate'];
                        $batch = isset($item['enrollment']) && $item['enrollment']->batch ? $item['enrollment']->batch : null;
                    @endphp
                    <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 backdrop-blur-xl flex flex-col md:flex-row md:items-center justify-between gap-6 hover:border-slate-700 transition-all">
                        <div class="space-y-3 flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="px-2.5 py-0.5 rounded-full bg-slate-800 text-brand-primary font-mono text-[10px] font-bold">
                                    {{ $c->course_title }}
                                </span>
                                @if($batch)
                                    <span class="px-2 py-0.5 rounded-full bg-slate-800/80 text-slate-300 font-mono text-[10px]">
                                        ব্যাচ: {{ $batch->batch_number }}
                                    </span>
                                @endif
                                <span class="px-2 py-0.5 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-400 font-mono text-[10px]">
                                    <i class="fa fa-map-marker mr-1"></i> ক্যাম্পাস ব্যাচ (Offline)
                                </span>

                                @if($isPub)
                                    <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-mono text-[10px] font-bold flex items-center gap-1">
                                        <i class="fa fa-check-circle"></i> সার্টিফিকেট প্রকাশিত
                                    </span>
                                @elseif($isPending)
                                    <span class="px-2.5 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 font-mono text-[10px] font-bold flex items-center gap-1">
                                        <i class="fa fa-clock-o"></i> অ্যাডমিন রিভিউ ও অনুমোদনাধীন
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full bg-slate-800 text-slate-400 font-mono text-[10px] font-bold">
                                        কোর্স চলমান (In Progress)
                                    </span>
                                @endif
                            </div>

                            <p class="text-xs text-slate-400 leading-relaxed">
                                @if($isPub)
                                    অভিনন্দন! আপনার অফলাইন কোর্স ও প্র্যাকটিক্যাল ল্যাব মূল্যায়ন সম্পন্ন হয়েছে এবং অ্যাডমিন কর্তৃক মূল সনদপত্র ইস্যু করা হয়েছে।
                                @elseif($isPending)
                                    আপনার কোর্স সমাপনী ডাটা ও ল্যাব প্রজেক্ট সাবমিশন অ্যাডমিন পোর্টাল থেকে যাচাই করা হচ্ছে। খুব শীঘ্রই সনদপত্র দৃশ্যমান হবে।
                                @else
                                    অফলাইন ক্যাম্পাসে ক্লাস উপস্থিতি, ল্যাব অনুশীলন এবং চূড়ান্ত পরীক্ষা সম্পন্ন হলে ওয়েক আপ আইসিটি অ্যাডমিন পোর্টাল থেকে সার্টিফিকেট প্রকাশ করা হবে।
                                @endif
                            </p>

                            <!-- Progress Bar -->
                            <div class="flex items-center gap-3">
                                <div class="flex-1 h-2 rounded-full bg-slate-800 overflow-hidden max-w-md">
                                    <div class="h-full rounded-full bg-gradient-to-r from-brand-primary to-brand-cyan transition-all duration-500" style="width: {{ $isPub ? 100 : max(15, $prog) }}%"></div>
                                </div>
                                <span class="text-[11px] font-mono text-slate-400">
                                    {{ $isPub ? '100% Completed' : ($prog > 0 ? $prog . '% Curriculum' : 'Active Training') }}
                                </span>
                            </div>
                        </div>

                        <div class="shrink-0 self-end md:self-auto">
                            @if($isPub && $cert)
                                <a href="{{ route('student.certificates.view', $cert->certificate_code) }}" target="_blank" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-black text-xs uppercase tracking-wider transition-all shadow-md flex items-center gap-2">
                                    <i class="fa fa-certificate"></i>
                                    <span>সার্টিফিকেট দেখুন</span>
                                </a>
                            @elseif($isPending)
                                <span class="px-4 py-2 rounded-xl bg-amber-500/10 text-amber-400 font-mono text-xs border border-amber-500/30 flex items-center gap-1.5">
                                    <i class="fa fa-spinner fa-spin"></i> প্রকাশের অপেক্ষায়
                                </span>
                            @else
                                <span class="px-4 py-2 rounded-xl bg-slate-950 text-slate-500 font-mono text-xs border border-slate-800 flex items-center gap-1.5">
                                    <i class="fa fa-lock"></i> অফলাইন মূল্যায়ন চলমান
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="student-card rounded-2xl bg-slate-900/60 border border-slate-800 p-8 text-center text-xs text-slate-400">
                বর্তমানে কোনো সক্রিয় কোর্স নেই। ক্যাম্পাসে ভর্তি নিশ্চিত হলে এখানে আপনার সার্টিফিকেট স্ট্যাটাস দেখতে পাবেন।
            </div>
        @endif
    </div>

</div>
@endsection
