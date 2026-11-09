@php
    $totalApplied = \App\model\Student::where('status', 1)->count();
    $totalAdmitted = \App\model\AdmitedStudent::where('status', 1)->count();
    $totalAccounts = \App\model\StudentAccount::count();
@endphp

<div class="card shadow-sm border-0 mb-3 bg-white rounded-lg">
    <div class="card-body p-2">
        <ul class="nav nav-pills nav-fill flex-column flex-sm-row font-weight-bold" style="font-family: 'Plus Jakarta Sans', 'Inter', 'Noto Sans Bengali', sans-serif;">
            <li class="nav-item m-1">
                <a class="nav-link py-2 {{ request()->is('students-list*') ? 'active bg-primary text-white shadow-sm' : 'text-dark bg-light' }}" href="{{ route('students-list') }}">
                    <i class="fas fa-user-edit mr-1"></i> Applied Students
                    <span class="badge {{ request()->is('students-list*') ? 'badge-light text-primary' : 'badge-primary text-white' }} ml-1">
                        {{ $totalApplied }}
                    </span>
                </a>
            </li>
            <li class="nav-item m-1">
                <a class="nav-link py-2 {{ request()->is('admited-students-list*') ? 'active bg-success text-white shadow-sm' : 'text-dark bg-light' }}" href="{{ route('admited-students-list') }}">
                    <i class="fas fa-user-graduate mr-1"></i> Admitted Students
                    <span class="badge {{ request()->is('admited-students-list*') ? 'badge-light text-success' : 'badge-success text-white' }} ml-1">
                        {{ $totalAdmitted }}
                    </span>
                </a>
            </li>
            <li class="nav-item m-1">
                <a class="nav-link py-2 {{ request()->is('student-accounts*') ? 'active bg-warning text-dark shadow-sm' : 'text-dark bg-light' }}" href="{{ route('admin.student-accounts.index') }}">
                    <i class="fas fa-id-badge mr-1"></i> Student Accounts
                    <span class="badge {{ request()->is('student-accounts*') ? 'badge-dark text-white' : 'badge-secondary text-white' }} ml-1">
                        {{ $totalAccounts }}
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>

