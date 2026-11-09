<!-- Modal edit-->
<div class="modal fade" id="editBatchModal{{ $batch->id }}" tabindex="-1" role="dialog" aria-labelledby="editBatchModalLabel{{ $batch->id }}"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title font-weight-bold" id="editBatchModalLabel{{ $batch->id }}">
                    <i class="fas fa-edit mr-1"></i> Edit Batch: {{ $batch->batch_number }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form method="POST" action="{{ route('insert-batch') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="batch_id" value="{{ $batch->id }}">
                    <div class="p-2">
                        <div class="form-group">
                            <label for="batch_code{{ $batch->id }}">Batch Code (Unique) <span class="text-danger">*</span></label>
                            <input class="form-control font-weight-bold" id="batch_code{{ $batch->id }}" name="batch_code" type="text"
                                placeholder="e.g. 05, 105, B01" required maxlength="20" value="{{ $batch->batch_code }}"
                                {{ $batch->isUsedInRegistration() ? 'readonly' : '' }}>
                            @if($batch->isUsedInRegistration())
                                <small class="text-muted d-block mt-1">
                                    <i class="fas fa-lock"></i> এই ব্যাচে শিক্ষার্থী নিবন্ধিত থাকায় ব্যাচ কোড অপরিবর্তনীয় (Immutable)।
                                </small>
                            @else
                                <small class="text-muted d-block mt-1">
                                    Can be 2 or more digits. Used in student registration numbers.
                                </small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="academic_year{{ $batch->id }}">Academic Year <span class="text-danger">*</span></label>
                            <input class="form-control" id="academic_year{{ $batch->id }}" name="academic_year" type="text"
                                placeholder="e.g. {{ date('Y') }}" required value="{{ $batch->academic_year ?: date('Y') }}">
                        </div>

                        <div class="form-group">
                            <label>Select Course <span class="text-danger">*</span></label>
                            <select name="course_id" id="course_id{{ $batch->id }}" required class="form-control select2" style="width: 100%;">
                                <option disabled value="">Select Course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}" {{ $course->id == $batch->course_id ? 'selected' : '' }}>
                                        {{ $course->course_title }} (Code: {{ $course->course_code }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date{{ $batch->id }}">Start Date <span class="text-danger">*</span></label>
                                    <input class="form-control" id="start_date{{ $batch->id }}" name="start_date" type="date" required
                                        value="{{ $batch->start_date ? $batch->start_date->format('Y-m-d') : '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date{{ $batch->id }}">End Date <span class="text-danger">*</span></label>
                                    <input class="form-control" id="end_date{{ $batch->id }}" name="end_date" type="date" required
                                        value="{{ $batch->end_date ? $batch->end_date->format('Y-m-d') : '' }}">
                                </div>
                            </div>
                        </div>
                        <small class="text-muted d-block mb-3">
                            <i class="fas fa-info-circle text-info"></i> ব্যাচের End Date পার হয়ে গেলে শিক্ষার্থীদের স্টুডেন্ট পোর্টাল অ্যাক্সেস স্বয়ংক্রিয়ভাবে বন্ধ হয়ে যাবে।
                        </small>

                        <div class="form-group">
                            <label for="active_batch{{ $batch->id }}">Status</label>
                            <select name="active_batch" id="active_batch{{ $batch->id }}" class="form-control">
                                <option value="1" {{ $batch->active_batch == 1 ? 'selected' : '' }}>Active (Visible in student registration)</option>
                                <option value="0" {{ $batch->active_batch == 0 ? 'selected' : '' }}>Inactive (Hidden from registration)</option>
                            </select>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary btn-block font-weight-bold">
                                <i class="fas fa-save mr-1"></i> Update Batch
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
