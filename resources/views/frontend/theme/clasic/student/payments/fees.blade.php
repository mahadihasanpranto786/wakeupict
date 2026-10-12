@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Course Fees & Payment Center — Wake Up ICT')
@section('page_title', 'Course Fees')
@section('page_crumb', 'Fee Breakdown & Payments')

@section('content')
<div class="max-w-7xl mx-auto space-y-8">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-money text-brand-primary"></i>
                <span>Course Fees, Installments &amp; Payments</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Transparent accounting overview for tuition fees, paid installments, and pending balances.
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('student.payments.history') }}" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold border border-slate-700 transition-colors flex items-center gap-1.5">
                <i class="fa fa-history"></i>
                <span>Payment History</span>
            </a>
            <a href="{{ route('student.receipts.index') }}" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-semibold border border-slate-700 transition-colors flex items-center gap-1.5">
                <i class="fa fa-print"></i>
                <span>Money Receipts</span>
            </a>
        </div>
    </div>

    <!-- Financial KPI Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 font-mono">
        <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl">
            <span class="text-xs text-slate-400 uppercase block mb-1">Total Fee</span>
            <span class="text-2xl font-black text-white">৳ {{ number_format($totalCourseFee) }}</span>
            <span class="text-[11px] text-slate-500 block mt-1 truncate" title="{{ $courseTitle }}">{{ $courseTitle }}</span>
        </div>

        <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl">
            <span class="text-xs text-slate-400 uppercase block mb-1">Scholarship / Waiver</span>
            <span class="text-2xl font-black text-amber-400">৳ {{ number_format($totalDiscount) }}</span>
            <span class="text-[11px] text-slate-500 block mt-1">Special admission discount</span>
        </div>

        <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl">
            <span class="text-xs text-slate-400 uppercase block mb-1">Net Payable</span>
            <span class="text-2xl font-black text-brand-cyan">৳ {{ number_format($payableAmount) }}</span>
            <span class="text-[11px] text-slate-500 block mt-1">After discount amount</span>
        </div>

        <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl">
            <span class="text-xs text-slate-400 uppercase block mb-1">Verified Paid</span>
            <span class="text-2xl font-black text-brand-primary">৳ {{ number_format($totalPaid) }}</span>
            <span class="text-[11px] text-slate-500 block mt-1">Confirmed with receipt</span>
        </div>

        <div class="student-card rounded-2xl bg-slate-900/80 border border-slate-800 p-5 backdrop-blur-xl">
            <span class="text-xs text-slate-400 uppercase block mb-1">Outstanding Due</span>
            <span class="text-2xl font-black {{ $totalDue > 0 ? 'text-rose-400' : 'text-emerald-400' }}">
                ৳ {{ number_format($totalDue) }}
            </span>
            <span class="text-[11px] text-slate-500 block mt-1">{{ $totalDue == 0 ? 'All fees cleared' : 'Due payment remaining' }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

        <!-- Left Column: Submit New Payment Form (7 cols) -->
        <div class="lg:col-span-7 space-y-6">
            <div class="student-card rounded-3xl bg-slate-900/90 border border-slate-800 p-6 sm:p-8 backdrop-blur-xl space-y-6">
                
                <div>
                    <h2 class="text-lg font-bold text-white flex items-center gap-2">
                        <i class="fa fa-credit-card text-brand-primary"></i>
                        <span>Submit Online Payment Notification</span>
                    </h2>
                    <p class="text-xs text-slate-400 mt-1">
                        Send payment via bKash, Nagad, Rocket, or Bank transfer, then enter transaction details below for accounts verification.
                    </p>
                </div>

                <!-- Payment Accounts Info Box -->
                <div class="p-4 rounded-2xl bg-slate-950/80 border border-slate-800 space-y-3 font-mono text-xs">
                    <span class="text-brand-primary font-bold uppercase text-[11px] block">
                        Official Wake Up ICT Payment Channels:
                    </span>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-slate-300">
                        <div class="p-2.5 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-between">
                            <span><strong class="text-rose-400">bKash</strong> (Personal):</span>
                            <span class="font-bold text-white select-all">01790-258055</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-between">
                            <span><strong class="text-orange-400">Nagad</strong> (Personal):</span>
                            <span class="font-bold text-white select-all">01790-258055</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-between">
                            <span><strong class="text-purple-400">Rocket</strong> (Personal):</span>
                            <span class="font-bold text-white select-all">01790-258055-8</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-900 border border-slate-800 flex items-center justify-between">
                            <span><strong class="text-blue-400">Bank</strong> (Islami Bank):</span>
                            <span class="font-bold text-white select-all">2050302010...</span>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form action="{{ route('student.payments.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-mono font-bold text-slate-300 uppercase">Select Course Program</label>
                            <select name="course_id" required class="w-full px-4 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-xs text-white focus:outline-none focus:border-brand-primary transition-all">
                                @foreach($courses as $c)
                                    <option value="{{ $c->id }}">{{ $c->course_title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-mono font-bold text-slate-300 uppercase">Payment Method</label>
                            <select name="payment_method" required class="w-full px-4 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-xs text-white focus:outline-none focus:border-brand-primary transition-all">
                                <option value="bkash">bKash</option>
                                <option value="nagad">Nagad</option>
                                <option value="rocket">Rocket</option>
                                <option value="bank_transfer">Bank Deposit / Transfer</option>
                                <option value="cash">Campus Cash Desk</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-mono font-bold text-slate-300 uppercase">Transaction ID (TrxID)</label>
                            <input type="text" name="transaction_id" required placeholder="e.g. 9J47K8A2" class="w-full px-4 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary transition-all">
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-mono font-bold text-slate-300 uppercase">Sender Mobile / Account Number</label>
                            <input type="text" name="sender_number" required placeholder="e.g. 017XXXXXXXX" class="w-full px-4 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="space-y-1.5">
                            <label class="block text-xs font-mono font-bold text-slate-300 uppercase">Amount Paid (৳ BDT)</label>
                            <input type="number" step="0.01" name="amount" required placeholder="e.g. 2500" value="{{ $totalDue > 0 ? $totalDue : '' }}" class="w-full px-4 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary transition-all font-mono">
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-xs font-mono font-bold text-slate-300 uppercase">Upload Payment Screenshot / Slip</label>
                            <input type="file" name="payment_proof_file" accept="image/*,.pdf" class="w-full p-2.5 rounded-xl bg-slate-950 border border-slate-800 text-xs text-slate-400 file:mr-2 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-[11px] file:bg-slate-800 file:text-white cursor-pointer">
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label class="block text-xs font-mono font-bold text-slate-300 uppercase">Additional Note / Remarks (Optional)</label>
                        <input type="text" name="student_note" placeholder="Installment note or reference..." class="w-full px-4 py-2.5 rounded-xl bg-slate-950 border border-slate-800 text-xs text-white placeholder-slate-500 focus:outline-none focus:border-brand-primary transition-all">
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full py-3.5 rounded-xl bg-brand-primary hover:bg-brand-accent text-slate-950 font-black text-xs uppercase tracking-wider transition-all shadow-glow-emerald flex items-center justify-center gap-2">
                            <i class="fa fa-paper-plane"></i>
                            <span>Submit Payment for Verification</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>

        <!-- Right Column: Installment Schedule & Quick Info (5 cols) -->
        <div class="lg:col-span-5 space-y-6">
            
            <div class="student-card rounded-3xl bg-slate-900/90 border border-slate-800 p-6 backdrop-blur-xl space-y-4">
                <h3 class="text-sm font-bold text-white flex items-center gap-2">
                    <i class="fa fa-calendar-check-o text-brand-primary"></i>
                    <span>Fee Installment Timeline</span>
                </h3>

                @if($installments->count() > 0)
                    <div class="space-y-3">
                        @foreach($installments as $ins)
                            @php
                                $overdue = $ins->isOverdue();
                            @endphp
                            <div class="p-3.5 rounded-2xl bg-slate-950/70 border border-slate-800/80 flex items-center justify-between text-xs font-mono">
                                <div>
                                    <span class="text-slate-400 block text-[10px]">Installment #{{ $ins->installment_number }}</span>
                                    <span class="text-white font-bold">Due: {{ $ins->due_date ? $ins->due_date->format('M d, Y') : '-' }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="text-brand-primary font-bold block">৳ {{ number_format($ins->amount) }}</span>
                                    @if($ins->status === 'paid')
                                        <span class="px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 text-[9px] font-bold">Paid</span>
                                    @elseif($overdue)
                                        <span class="px-2 py-0.5 rounded bg-rose-500/10 text-rose-400 text-[9px] font-bold">Overdue</span>
                                    @else
                                        <span class="px-2 py-0.5 rounded bg-amber-500/10 text-amber-400 text-[9px] font-bold">Upcoming</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-4 rounded-2xl bg-slate-950/40 border border-slate-800/60 text-xs text-slate-400 leading-relaxed">
                        No customized installment schedule assigned. Tuition is handled under standard admission term terms.
                    </div>
                @endif
            </div>

            <!-- Money Receipt Notice -->
            <div class="student-card rounded-3xl bg-slate-900/90 border border-slate-800 p-6 backdrop-blur-xl space-y-3 text-xs">
                <h4 class="font-bold text-white flex items-center gap-2">
                    <i class="fa fa-shield text-brand-cyan"></i>
                    <span>Verified Payment Receipts</span>
                </h4>
                <p class="text-slate-400 leading-relaxed">
                    Once our accounts team confirms your transaction hash, an official computer-generated receipt with unique invoice code will be issued under your portal.
                </p>
                <a href="{{ route('student.receipts.index') }}" class="text-brand-primary hover:underline font-mono text-[11px] font-semibold inline-block">
                    View Verified Receipts Archive &rarr;
                </a>
            </div>

        </div>

    </div>

</div>
@endsection
