@extends('frontend.theme.clasic.student.layouts.student_layout')

@section('title', 'Notifications & Broadcasts — Wake Up ICT')
@section('page_title', 'Notifications & Announcements')
@section('page_crumb', 'Updates & Alerts')

@section('content')
<div class="max-w-6xl mx-auto space-y-6">

    <!-- Header & Action Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-800">
        <div>
            <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2.5">
                <i class="fa fa-bell text-brand-primary"></i>
                <span>Notifications &amp; Announcements</span>
            </h1>
            <p class="text-xs sm:text-sm text-slate-400 mt-1">
                Stay updated on class schedules, fee dues, quiz publications, and official institutional notices.
            </p>
        </div>
        <div class="flex items-center gap-3">
            @if($unreadCount > 0)
                <form action="{{ route('student.notifications.mark-all-read') }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 border border-slate-700 hover:border-slate-600 text-xs text-slate-200 font-semibold transition-all flex items-center gap-2">
                        <i class="fa fa-check-double text-brand-primary"></i>
                        <span>Mark All as Read</span>
                    </button>
                </form>
            @endif
            <span class="px-3 py-1.5 rounded-xl bg-brand-primary/10 border border-brand-primary/20 text-brand-primary font-mono text-xs">
                Unread: <strong>{{ $unreadCount }}</strong>
            </span>
        </div>
    </div>

    <!-- Filters Bar -->
    <div class="flex flex-wrap items-center gap-2">
        <a href="{{ route('student.notifications.index') }}" 
           class="px-4 py-2 rounded-xl text-xs font-semibold transition-all {{ !request('filter') ? 'bg-brand-primary text-slate-950 font-bold shadow-glow-emerald' : 'bg-slate-900 border border-slate-800 text-slate-400 hover:text-white' }}">
            All Notifications
        </a>
        <a href="{{ route('student.notifications.index', ['filter' => 'unread']) }}" 
           class="px-4 py-2 rounded-xl text-xs font-semibold transition-all {{ request('filter') === 'unread' ? 'bg-brand-primary text-slate-950 font-bold shadow-glow-emerald' : 'bg-slate-900 border border-slate-800 text-slate-400 hover:text-white' }}">
            Unread ({{ $unreadCount }})
        </a>
        <a href="{{ route('student.notifications.index', ['filter' => 'announcements']) }}" 
           class="px-4 py-2 rounded-xl text-xs font-semibold transition-all {{ request('filter') === 'announcements' ? 'bg-brand-primary text-slate-950 font-bold shadow-glow-emerald' : 'bg-slate-900 border border-slate-800 text-slate-400 hover:text-white' }}">
            Institutional Announcements
        </a>
    </div>

    <!-- Notifications List -->
    @if($notifications->count() > 0)
        <div class="space-y-4">
            @foreach($notifications as $notif)
                @php
                    $isUnread = !$notif->is_read;
                    $borderClass = $isUnread ? 'border-brand-primary/40 bg-slate-900/90' : 'border-slate-800/80 bg-slate-900/50';
                    $iconClass = 'fa-info-circle text-blue-400';
                    if ($notif->type === 'success') $iconClass = 'fa-check-circle text-emerald-400';
                    elseif ($notif->type === 'warning') $iconClass = 'fa-exclamation-triangle text-amber-400';
                    elseif ($notif->type === 'danger') $iconClass = 'fa-bolt text-rose-400';
                    elseif ($notif->type === 'announcement') $iconClass = 'fa-bullhorn text-brand-primary';
                @endphp
                <div class="student-card rounded-2xl border {{ $borderClass }} p-5 sm:p-6 transition-all hover:border-slate-700 backdrop-blur-xl relative" id="notif-card-{{ $notif->id }}">
                    <div class="flex items-start gap-4">
                        <!-- Icon Circle -->
                        <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-2xl bg-slate-950/80 border border-slate-800 flex items-center justify-center flex-shrink-0 text-lg">
                            <i class="fa {{ $iconClass }}"></i>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 space-y-2">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h3 class="text-sm sm:text-base font-bold text-white {{ $isUnread ? 'font-extrabold' : '' }}">
                                        {{ $notif->title }}
                                    </h3>
                                    @if(is_null($notif->student_account_id))
                                        <span class="px-2 py-0.5 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-300 font-mono text-[10px] uppercase font-bold">
                                            Announcement
                                        </span>
                                    @endif
                                    @if($notif->course)
                                        <span class="px-2 py-0.5 rounded-full bg-blue-500/10 border border-blue-500/20 text-blue-300 font-mono text-[10px]">
                                            {{ $notif->course->course_title }}
                                        </span>
                                    @endif
                                </div>
                                <span class="text-slate-400 text-xs font-mono flex items-center gap-1.5 flex-shrink-0">
                                    <i class="fa fa-clock"></i>
                                    {{ $notif->created_at->diffForHumans() }}
                                </span>
                            </div>

                            <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
                                {{ $notif->message }}
                            </p>

                            <div class="pt-2 flex flex-wrap items-center justify-between gap-3">
                                <div>
                                    @if($notif->action_url)
                                        <a href="{{ $notif->action_url }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-brand-primary/10 hover:bg-brand-primary text-brand-primary hover:text-slate-950 font-semibold text-xs transition-all border border-brand-primary/20">
                                            <span>View Details</span>
                                            <i class="fa fa-arrow-right text-[10px]"></i>
                                        </a>
                                    @endif
                                </div>

                                <div class="flex items-center gap-2">
                                    @if($isUnread)
                                        <button onclick="markRead({{ $notif->id }})" class="text-xs text-slate-400 hover:text-brand-primary transition-colors flex items-center gap-1 px-2.5 py-1 rounded bg-slate-950/50 border border-slate-800" id="mark-btn-{{ $notif->id }}">
                                            <i class="fa fa-check"></i>
                                            <span>Mark Read</span>
                                        </button>
                                    @else
                                        <span class="text-[11px] text-slate-500 font-mono flex items-center gap-1">
                                            <i class="fa fa-check-double text-slate-600"></i> Read
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div class="pt-4">
                {{ $notifications->links() }}
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="student-card p-12 text-center rounded-3xl bg-slate-900/60 border border-slate-800 space-y-4">
            <div class="w-16 h-16 rounded-full bg-slate-800 text-slate-500 flex items-center justify-center mx-auto text-2xl">
                <i class="fa fa-bell-slash"></i>
            </div>
            <h3 class="text-base font-bold text-white">No notifications found</h3>
            <p class="text-xs sm:text-sm text-slate-400 max-w-md mx-auto">
                You're completely caught up! We will notify you whenever there are new course schedules, quiz results, or announcements.
            </p>
        </div>
    @endif

</div>

<script>
function markRead(id) {
    const btn = document.getElementById('mark-btn-' + id);
    if (btn) btn.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';

    fetch('{{ url("student/notifications") }}/' + id + '/mark-read', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.status === 'success') {
            const card = document.getElementById('notif-card-' + id);
            if (card) {
                card.classList.remove('border-brand-primary/40');
                card.classList.add('border-slate-800/80');
            }
            if (btn) {
                btn.outerHTML = '<span class="text-[11px] text-slate-500 font-mono flex items-center gap-1"><i class="fa fa-check-double text-slate-600"></i> Read</span>';
            }
        }
    })
    .catch(err => {
        console.error(err);
        if (btn) btn.innerHTML = '<i class="fa fa-check"></i> Mark Read';
    });
}
</script>
@endsection
