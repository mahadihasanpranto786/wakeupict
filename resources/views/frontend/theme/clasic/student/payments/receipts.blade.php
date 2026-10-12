@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Official Money Receipts — Wake Up ICT')
@section('page_title', 'Money Receipts')
@section('page_crumb', 'Official Vouchers')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-print text-brand-primary"></i>
                <span>Official Money Receipts &amp; Vouchers</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Download and print officially verified invoices with verified accounts serial numbers.
            </p>
        </div>
        <a href="{{ route('student.fees.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold border border-slate-700 transition-colors self-start sm:self-auto">
            <i class="fa fa-money"></i>
            <span>Course Fees Statement</span>
        </a>
    </div>

    @if($receipts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($receipts as $rc)
                <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-6 flex flex-col justify-between hover:border-slate-700 transition-all group backdrop-blur-xl space-y-4">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between gap-2">
                            <span class="px-2.5 py-0.5 rounded-full bg-slate-800 text-brand-primary font-mono text-[10px] font-bold">
                                {{ $rc->receipt_number }}
                            </span>
                            <span class="px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 font-mono text-[10px] font-bold">
                                Paid &bull; Verified
                            </span>
                        </div>

                        <h3 class="text-base font-bold text-white group-hover:text-brand-primary transition-colors line-clamp-2 leading-snug">
                            {{ $rc->course ? $rc->course->course_title : 'Tuition Fee Payment' }}
                        </h3>

                        <div class="p-3 rounded-2xl bg-slate-950/60 border border-slate-800/80 space-y-1 text-xs font-mono">
                            <div class="flex justify-between text-slate-400">
                                <span>Date:</span>
                                <span class="text-white">{{ $rc->verified_at ? $rc->verified_at->format('M d, Y') : $rc->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex justify-between text-slate-400">
                                <span>Method:</span>
                                <span class="text-slate-300 uppercase">{{ $rc->payment_method }}</span>
                            </div>
                            <div class="flex justify-between text-slate-400">
                                <span>TrxID:</span>
                                <span class="text-slate-300 select-all">{{ $rc->transaction_id }}</span>
                            </div>
                            <div class="flex justify-between text-slate-400 pt-1 border-t border-slate-800/60">
                                <span class="font-bold text-white">Amount:</span>
                                <span class="font-bold text-brand-primary text-sm">৳ {{ number_format($rc->amount) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-800/80">
                        <a href="{{ route('student.receipts.print', $rc->receipt_number) }}" target="_blank" class="w-full justify-center px-4 py-2.5 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center gap-2">
                            <i class="fa fa-print"></i>
                            <span>Print / Download Receipt</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 p-12 text-center max-w-lg mx-auto">
            <div class="w-16 h-16 rounded-2xl bg-brand-primary/10 text-brand-primary flex items-center justify-center mx-auto mb-4 text-2xl">
                <i class="fa fa-print"></i>
            </div>
            <h3 class="text-base font-bold text-white mb-2">No Verified Receipts Found</h3>
            <p class="text-xs text-slate-400 mb-6 leading-relaxed">
                Official money receipts appear here automatically once your tuition payments are reviewed and verified by accounts desk.
            </p>
            <a href="{{ route('student.fees.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-brand-primary text-slate-950 font-bold text-xs uppercase tracking-wider shadow-glow-emerald">
                <span>Submit Fee Payment</span>
            </a>
        </div>
    @endif

</div>
@endsection
