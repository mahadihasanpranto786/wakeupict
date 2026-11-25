<!-- Table Content -->
<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table table-hover table-striped mb-0 text-sm">
            <thead class="thead-dark">
                <tr>
                    <th style="width: 3%">#</th>
                    <th>Student Details</th>
                    <th>Registration Number</th>
                    <th>Course</th>
                    <th>Batch</th>
                    <th>Submitted On</th>
                    <th>Portal Status</th>
                    <th style="width: 18%">Verification Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registrations as $index => $item)
                    @php
                        $primaryCourse = $item->course;
                        $primaryBatch = $item->batch;
                    @endphp
                    <tr>
                        <td>{{ ($registrations->firstItem() ?? 1) + $index }}</td>
                        <td>
                            <div class="font-weight-bold text-dark">{{ $item->name }}</div>
                            <div class="small text-muted">
                                <i class="fas fa-phone mr-1"></i> <a href="tel:{{ $item->phone }}">{{ $item->phone }}</a>
                                @if($item->email)
                                    <span class="mx-1">|</span> <i class="fas fa-envelope mr-1"></i> {{ $item->email }}
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="font-mono font-weight-bold text-primary" style="font-size: 14px;">
                                {{ $item->registration_number ?: 'N/A' }}
                            </div>
                        </td>
                        <td>
                            @if($primaryCourse)
                                <span class="font-weight-bold">{{ $primaryCourse->course_title }}</span>
                                <span class="badge badge-light font-mono ml-1">{{ $primaryCourse->course_code }}</span>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                            @if($primaryBatch)
                                <span class="badge badge-secondary font-mono">{{ $primaryBatch->batch_number }}</span>
                                <small class="d-block text-muted">Code: {{ $primaryBatch->batch_code }}</small>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                            <div>{{ $item->created_at ? $item->created_at->format('d M, Y') : 'N/A' }}</div>
                            <small class="text-muted">{{ $item->created_at ? $item->created_at->format('h:i A') : '' }}</small>
                        </td>
                        <td>
                            @if($item->registration_status === 'approved')
                                <span class="badge badge-success px-2 py-1">
                                    <i class="fas fa-check-circle mr-1"></i> Approved
                                </span>
                                @if($item->verified_at)
                                    <small class="d-block text-muted mt-1 font-sans">
                                        By: {{ $item->verifiedBy ? $item->verifiedBy->name : 'Admin' }} ({{ $item->verified_at->format('d M') }})
                                    </small>
                                @endif
                            @elseif($item->registration_status === 'rejected')
                                <span class="badge badge-danger px-2 py-1">
                                    <i class="fas fa-ban mr-1"></i> Rejected
                                </span>
                                @if($item->rejection_reason)
                                    <small class="d-block text-danger mt-1 font-italic" title="{{ $item->rejection_reason }}">
                                        {{ Str::limit($item->rejection_reason, 25) }}
                                    </small>
                                @endif
                            @else
                                <span class="badge badge-warning px-2 py-1 text-dark">
                                    <i class="fas fa-clock mr-1"></i> Pending Verification
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                @if($item->registration_status !== 'approved')
                                    <!-- Approve Button -->
                                    <form method="POST" action="{{ route('admin.registrations.approve', $item->id) }}" class="d-inline" onsubmit="return confirm('Approve {{ $item->name }} ({{ $item->registration_number }}) and grant student portal access?')">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm font-weight-bold" title="Approve Student Portal Access">
                                            <i class="fas fa-check mr-1"></i> Approve
                                        </button>
                                    </form>
                                @endif

                                @if($item->registration_status !== 'rejected')
                                    <!-- Reject Button (Modal Trigger) -->
                                    <button type="button" class="btn btn-outline-danger btn-sm font-weight-bold ml-1" data-toggle="modal" data-target="#rejectModal{{ $item->id }}" title="Reject Registration">
                                        <i class="fas fa-times mr-1"></i> Reject
                                    </button>
                                @endif

                                <!-- Details & Password Modal Trigger -->
                                <button type="button" class="btn btn-outline-info btn-sm font-weight-bold ml-1" data-toggle="modal" data-target="#infoModal{{ $item->id }}" title="View Credentials & Password">
                                    <i class="fas fa-eye mr-1"></i> Details
                                </button>

                                <!-- Student Full Result Tree Button -->
                                <a href="{{ route('admin.quizzes.reports.student-tree', $item->id) }}" class="btn btn-outline-primary btn-sm font-weight-bold ml-1" title="শিক্ষার্থীর সম্পূর্ণ পরীক্ষার ফলাফল ট্রি দেখুন">
                                    <i class="fas fa-sitemap mr-1"></i> ফলাফল ট্রি
                                </a>

                                <!-- Delete / Purge Spam Registration Button -->
                                <form method="POST" action="{{ route('admin.registrations.destroy', $item->id) }}" class="d-inline ml-1" onsubmit="return confirm('আপনি কি নিশ্চিতভাবে {{ $item->name }} এর রেজিস্ট্রেশন রেকর্ডটি মুছে ফেলতে চান?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete Spam Registration">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>

                            <!-- Student Info & Credentials Modal -->
                            <div class="modal fade" id="infoModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content shadow-lg border-0 text-left">
                                        <div class="modal-header bg-dark text-white py-3">
                                            <h5 class="modal-title font-weight-bold">
                                                <i class="fas fa-user-circle mr-1 text-warning"></i> {{ $item->name }}
                                            </h5>
                                            <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body p-4 text-left" style="background-color: #F8FAFC;">
                                            <!-- Login Credentials Highlight Box -->
                                            <div class="p-3 rounded-lg mb-3" style="background: linear-gradient(135deg, #FFFBEB 0%, #FEF3C7 100%); border: 1px solid #FDE68A;">
                                                <h6 class="font-weight-bold text-dark mb-2">
                                                    <i class="fas fa-key text-warning mr-1"></i> স্টুডেন্ট পোর্টাল লগইন ও পাসওয়ার্ড (Portal Credentials)
                                                </h6>
                                                <div class="mb-2">
                                                    <span class="small text-muted d-block font-weight-bold">Registration / Student ID:</span>
                                                    <strong class="font-mono text-primary" style="font-size: 15px;">{{ $item->registration_number ?: 'N/A' }}</strong>
                                                </div>
                                                <div class="mb-2">
                                                    <span class="small text-muted d-block font-weight-bold">Login Phone Number:</span>
                                                    <strong class="font-mono text-dark" style="font-size: 14px;">{{ $item->phone }}</strong>
                                                </div>
                                                <div class="mb-1">
                                                    <span class="small text-muted d-block font-weight-bold mb-1">Student Password (পাসওয়ার্ড):</span>
                                                    <div class="input-group shadow-sm rounded-lg overflow-hidden border border-warning" style="background: #ffffff;">
                                                        <input type="password" id="verifyModalPass{{ $item->id }}" class="form-control font-mono font-weight-bold bg-white text-dark border-0 px-3 py-2" value="{{ $item->display_password }}" readonly style="font-size: 16px; letter-spacing: 2px; height: 48px;">
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-dark px-3 px-sm-3.5 d-flex align-items-center justify-content-center" onclick="togglePassView('verifyModalPass{{ $item->id }}', this)" title="Show / Hide Password" style="min-width: 48px; border-radius: 0;">
                                                                <i class="fas fa-eye" style="font-size: 16px;"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-warning font-weight-bold text-dark px-3 px-sm-3.5 d-flex align-items-center justify-content-center" onclick="copyPassVal('verifyModalPass{{ $item->id }}', this)" title="Copy Password" style="min-width: 50px; background-color: #f59e0b; border-color: #d97706; border-radius: 0;">
                                                                <i class="fas fa-copy" style="font-size: 16px;"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <small class="text-muted d-block mt-1 font-sans">
                                                        <i class="fas fa-info-circle mr-1 text-warning"></i>{{ !empty($item->plain_password) ? 'স্টুডেন্টের নিজস্ব সেট করা পাসওয়ার্ড' : 'প্রাথমিক ডিফল্ট পাসওয়ার্ড (মোবাইল নম্বরের শেষ ৬ ডিজিট)' }}
                                                    </small>
                                                </div>
                                            </div>

                                            <!-- Other info -->
                                            <div class="card border-0 shadow-sm p-3 bg-white">
                                                <p class="mb-1 small"><strong>Course:</strong> {{ $primaryCourse ? $primaryCourse->course_title : 'N/A' }}</p>
                                                <p class="mb-1 small"><strong>Batch:</strong> {{ $primaryBatch ? $primaryBatch->batch_number . ' (Code: ' . $primaryBatch->batch_code . ')' : 'N/A' }}</p>
                                                <p class="mb-1 small"><strong>Email:</strong> {{ $item->email ?: 'N/A' }}</p>
                                                <p class="mb-0 small"><strong>Registered On:</strong> {{ $item->created_at ? $item->created_at->format('d M, Y h:i A') : 'N/A' }}</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light py-2 d-flex justify-content-between align-items-center">
                                            <form method="POST" action="{{ route('admin.registrations.destroy', $item->id) }}" onsubmit="return confirm('আপনি কি নিশ্চিতভাবে এই রেজিস্ট্রেশন রেকর্ডটি মুছে ফেলতে চান?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm font-weight-bold" title="Delete Spam / Invalid Record">
                                                    <i class="fas fa-trash-alt mr-1"></i> Delete Spam
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Rejection Modal -->
                            <div class="modal fade" id="rejectModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('admin.registrations.reject', $item->id) }}">
                                            @csrf
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title font-weight-bold">
                                                    <i class="fas fa-user-times mr-1"></i> Reject Registration: {{ $item->name }}
                                                </h5>
                                                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="text-muted small">
                                                    Rejecting this registration will block this student from accessing the student dashboard.
                                                </p>
                                                <div class="form-group">
                                                    <label for="reason{{ $item->id }}" class="font-weight-bold">Reason for Rejection <span class="text-danger">*</span></label>
                                                    <textarea name="rejection_reason" id="reason{{ $item->id }}" class="form-control" rows="3" required placeholder="e.g. Invalid documents, phone number not reachable, unpaid admission fee..."></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger font-weight-bold">Confirm Rejection</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">
                            <i class="fas fa-inbox fa-3x mb-2 d-block"></i>
                            No student registrations found matching the criteria.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
@if($registrations->hasPages())
    <div class="card-footer bg-white py-3 border-top">
        <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
            <div class="small text-muted font-sans font-weight-bold my-1">
                Showing {{ $registrations->firstItem() }} to {{ $registrations->lastItem() }} of {{ $registrations->total() }} registrations
            </div>
            <div class="ml-auto my-1 d-flex justify-content-end align-items-center pagination-right-align">
                {{ $registrations->links() }}
            </div>
        </div>
    </div>
@endif
