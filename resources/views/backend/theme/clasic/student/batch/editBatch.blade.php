<!-- Modal edit-->
<div class="modal fade" id="editBatchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Batch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                            <label for="batch_number"> Batch Number </label>
                            <input class="form-control" id="batch_number" name="batch_number" type="text"
                                placeholder="Enter Batch Number" data-validation='required'
                                value="{{ $batch->batch_number }}">
                        </div>

                        <div class="form-group">
                            <label>Select Course</label>
                            <select name="course_id" id="course_id" data-validation='required'
                                class="form-control select2" style="width: 100%;">
                                <option selected disabled>Select Course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ $course->id == $batch->course_id ? 'selected' : '' }}>
                                        {{ $course->course_title }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                                <span class="text-danger font-weight-bold">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Select Course Type</label>
                            <select id="expenseType" name="batch_type" data-validation='required'
                                class="form-control select2 batch_type" style="width: 100%;">
                                <option label="Choose type" selected disabled>Select One</option>
                                @if (user(Auth::id()) == 1)
                                    <option value="Local" {{ 'Local' == $batch->batch_type ? 'selected' : '' }}>Local
                                    </option>
                                @elseif (user(Auth::id()) == 2)
                                    <option value="Global" {{ 'Global' == $batch->batch_type ? 'selected' : '' }}>
                                        Global
                                    </option>
                                @else
                                    <option value="Local" {{ 'Local' == $batch->batch_type ? 'selected' : '' }}>Local
                                    </option>
                                    <option value="Global" {{ 'Global' == $batch->batch_type ? 'selected' : '' }}>
                                        Global
                                    </option>
                                @endif

                            </select>
                            @error('batch_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Select Category</label>
                            <select name="title_id" id="title_id" data-validation='required'
                                class="form-control select2" style="width: 100%;">
                                <option label="Choose category" selected disabled>Select One</option>
                            </select>
                            @error('title_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block align-top">
                                Update</button>
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
