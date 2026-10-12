@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Payment History & Transactions — Wake Up ICT')
@section('page_title', 'Payment History')
@section('page_crumb', 'Transaction Ledger')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-history text-brand-primary"></i>
                <span>Payment History &amp; Transaction Ledger</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Complete log of tuition fees paid, verification statuses, and historical accounts records.
            </p>
        </div>
        <a href="{{ route('student.fees.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-glow-emerald self-start sm:self-auto">
            <i class="fa fa-plus"></i>
            <span>Submit New Payment</span>
        </a>
    </div>

    <!-- Online Payments Table -->
    <div class="space-y-4">
        <h2 class="text-base font-bold text-white flex items-center gap-2">
            <i class="fa fa-credit-card text-brand-primary"></i>
            <span>Online Payment Submissions</span>
        </h2>

        @if($onlinePayments->count() > 0)
            <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 overflow-hidden backdrop-blur-xl shadow-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs font-mono">
                        <thead class="bg-slate-950/80 text-slate-400 uppercase text-[10px] border-b border-slate-800">
                            <tr>
                                <th class="p-4">Receipt #</th>
                                <th class="p-4">Date</th>
                                <th class="p-4">Course Program</th>
                                <th class="p-4">Method &amp; TrxID</th>
                                <th class="p-4">Amount</th>
                                <th class="p-4">Status</th>
                                <th class="p-4 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60 text-slate-300">
                            @foreach($onlinePayments as $pay)
                                <tr class="hover:bg-slate-850/40 transition-colors">
                                    <td class="p-4 font-bold text-white">{{ $pay->receipt_number ?: '-' }}</td>
                                    <td class="p-4 text-slate-400">{{ $pay->created_at->format('M d, Y') }}</td>
                                    <td class="p-4 text-slate-300">{{ $pay->course ? $pay->course->course_title : 'Course' }}</td>
                                    <td class="p-4">
                                        <span class="text-white font-bold uppercase">{{ $pay->payment_method }}</span>
                                        <span class="text-slate-500 block text-[11px]">{{ $pay->transaction_id }}</span>
                                    </td>
                                    <td class="p-4 font-bold text-brand-primary text-sm">৳ {{ number_format($pay->amount) }}</td>
                                    <td class="p-4">
                                        @if($pay->status === 'verified')
                                            <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[10px] font-bold">
                                                Verified
                                            </span>
                                        @elseif($pay->status === 'rejected')
                                            <span class="px-2.5 py-0.5 rounded-full bg-rose-500/10 border border-rose-500/20 text-rose-400 text-[10px] font-bold">
                                                Rejected
                                            </span>
                                        @else
                                            <span class="px-2.5 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 text-[10px] font-bold">
                                                Pending Review
                                            </span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-right">
                                        @if($pay->status === 'verified' && $pay->receipt_number)
                                            <a href="{{ route('student.receipts.print', $pay->receipt_number) }}" target="_blank" class="px-3 py-1.5 rounded-xl bg-slate-800 hover:bg-brand-primary hover:text-slate-950 text-slate-200 text-xs font-semibold transition-all">
                                                <i class="fa fa-print mr-1"></i> Receipt
                                            </a>
                                        @else
                                            <span class="text-slate-500 text-[11px]">Processing</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="student-card rounded-2xl bg-slate-900/60 border border-slate-800 p-8 text-center text-xs text-slate-400">
                No online payment submissions recorded yet.
            </div>
        @endif
    </div>

    <!-- Legacy Campus Payments (if admitted student) -->
    @if($legacyPayments->count() > 0)
        <div class="space-y-4 pt-4">
            <h2 class="text-base font-bold text-white flex items-center gap-2">
                <i class="fa fa-building text-brand-cyan"></i>
                <span>Campus Desk &amp; Admission Payments</span>
            </h2>

            <div class="student-card rounded-3xl bg-slate-900/80 border border-slate-800 overflow-hidden backdrop-blur-xl shadow-xl">
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs font-mono">
                        <thead class="bg-slate-950/80 text-slate-400 uppercase text-[10px] border-b border-slate-800">
                            <tr>
                                <th class="p-4">Transaction ID</th>
                                <th class="p-4">Date</th>
                                <th class="p-4">Mobile</th>
                                <th class="p-4">Remarks</th>
                                <th class="p-4">Amount Paid</th>
                                <th class="p-4 text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800/60 text-slate-300">
                            @foreach($legacyPayments as $lp)
                                <tr class="hover:bg-slate-850/40 transition-colors">
                                    <td class="p-4 font-bold text-white">#PAY-{{ $lp->id }}</td>
                                    <td class="p-4 text-slate-400">{{ $lp->date }}</td>
                                    <td class="p-4 text-slate-400">{{ $lp->mobile }}</td>
                                    <td class="p-4 text-slate-300">{{ $lp->remark ?: 'Campus Office Payment' }}</td>
                                    <td class="p-4 font-bold text-brand-primary text-sm">৳ {{ number_format($lp->paid) }}</td>
                                    <td class="p-4 text-right">
                                        <span class="px-2.5 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-[10px] font-bold">
                                            Recorded
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

</div>
@endsection
