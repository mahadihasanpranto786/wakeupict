@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    About HR Card For {{ $about->name }}
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('about_page', 'menu-open')

@section('menu_active_about', 'active bg-info')

@section('about_list_active', 'active')
{{-- menu active end --}}

@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            Info Table
                        </div>
                        <div class="card-body">
                            <div class="my-2">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNew">
                                    <i class="fas fa-plus-circle"></i> Add Info
                                </button>
                            </div>
                            @if ($about->singleAboutDetail)
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="10%">Image</th>
                                            <th style="10%">Employee Type </th>
                                            <th style="10%">
                                                Date
                                            </th>
                                            @if (checkUserType() == 0)
                                                <th style="10%">Action</th>
                                            @endif
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>
                                                <img width="100px" src="{{ URL::asset($about->image) }}" alt="loading">
                                            </td>
                                            <td>
                                                {{ $about->singleAboutDetail->employee_type }}
                                            </td>
                                            <td>
                                                <strong>Joining Date: {{ $about->singleAboutDetail->joining_date }}</strong>
                                                <br>
                                                @if ($about->singleAboutDetail->end_date)
                                                    <strong>End Date: {{ $about->singleAboutDetail->end_date }}</strong>
                                                    <br>
                                                @else
                                                    Currently Working
                                                @endif
                                            </td>
                                            @if (checkUserType() == 0)
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#addNew">
                                                        <i class="fas fa-pencil-alt text-white"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target="#description_show">
                                                        Show Description
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <div class="card">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-header">
                            (Love To Work Wtih) Table
                        </div>
                        <div class="card-body">
                            <div class="my-2">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#assignNewStack">
                                    <i class="fas fa-plus-circle"></i> Add Stack
                                </button>
                            </div>
                            @if ($about->assign_stacks)
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Logo</th>
                                            <th>Name </th>
                                            @if (checkUserType() == 0)
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($about->assign_stacks as $assign)
                                            <tr>
                                                <td>
                                                    <img width="40px" src="{{ URL::asset($assign->stack->logo) }}" alt="loading">
                                                </td>
                                                <td>
                                                    {{ $assign->stack->name }}
                                                </td>
                                                @if (checkUserType() == 0)
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="{{ url('delete-assign-asset/'. $assign->id) }}" id="delete" type="button" class="btn btn-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-header">
                            All Stack Table
                        </div>
                        <div class="card-body">
                            <div class="my-2">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#addNewStack">
                                    <i class="fas fa-plus-circle"></i> Add New Stack
                                </button>
                            </div>
                            @if ($stacks)
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Logo</th>
                                            <th>Name </th>
                                            @if (checkUserType() == 0)
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($stack_lists as $stack)
                                            <tr>
                                                <td>
                                                    <img width="50px" src="{{ URL::asset($stack->logo) }}" alt="loading">
                                                </td>
                                                <td>
                                                    {{ $stack->name }}
                                                </td>

                                                @if (checkUserType() == 0)
                                                    <td>
                                                        <div class="d-flex">
                                                            <button type="button" class="btn btn-primary editStack"
                                                                data-toggle="modal" data-stack="{{ $stack }}"
                                                                data-logo="{{ URL::asset($stack->logo) }}"
                                                                data-target="#editStack">
                                                                <i class="fas fa-pencil-alt text-white"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div>
                                    {{ $stack_lists->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>

            <div class="card">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            Project Completed By {{ $about->name }}
                        </div>
                        <div class="card-body">
                            <div class="my-2">
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#addNewProject">
                                    <i class="fas fa-plus-circle"></i> Add Project
                                </button>
                            </div>
                            @if ($about->projects)
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Project Title</th>
                                            <th>Short Description</th>
                                            <th>Date</th>
                                            @if (checkUserType() == 0)
                                                <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($about->projects as $project)
                                            <tr>
                                                <td>
                                                    {{ $project->project_title }}
                                                </td>
                                                <td>
                                                    {{ $project->short_description }}
                                                </td>
                                                <td>
                                                    <strong>Start Date: {{ $project->start_date }}</strong> <br>
                                                    @if (!$project->currently_working_status)
                                                        <strong>End Date: {{ $project->end_date }}</strong> <br>
                                                    @else
                                                        <strong>Present</strong>
                                                    @endif
                                                </td>
                                                @php
                                                    $start_date = $project ? \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') : '';
                                                    $end_date = $project ? \Carbon\Carbon::parse($project->end_date)->format('Y-m-d') : '';
                                                    $is_checked = $project->currently_working_status == 1 ? 'checked' : '';
                                                @endphp
                                                @if (checkUserType() == 0)
                                                    <td>
                                                        <div class="d-flex">
                                                            <button type="button" class="btn btn-primary editProject"
                                                                data-toggle="modal" data-project="{{ $project }}"
                                                                data-start="{{ $start_date }}"
                                                                @if ($project->end_date)
                                                                data-end="{{ $end_date }}"
                                                                @endif
                                                                data-checked="{{ $is_checked }}"
                                                                data-target="#editProject">
                                                                <i class="fas fa-pencil-alt text-white"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.col -->
    </div>

    <!-- Modal for insert info -->
    <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-success">
                    <h5 class="modal-title" id="exampleModalLabel">Add Info For {{ $about->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="card">
                            <form id="addData">
                                <div class="card-body">
                                    <input type="hidden" name="about_card_id" value="{{ $about->id }}">
                                    <div class="form-group">
                                        <label for="employee_type">Employee Type</label>
                                        <input type="text" name="employee_type" id="employee_type"
                                            class="form-control" placeholder="Ex: Full Time"
                                            value="{{ $about->singleAboutDetail ? $about->singleAboutDetail->employee_type : '' }}">

                                        <span class="text-danger validate" data-field="employee_type"></span>
                                    </div>
                                    @php
                                        $joining_date = $about->singleAboutDetail ? \Carbon\Carbon::parse($about->singleAboutDetail->joining_date)->format('Y-m-d') : '';
                                        $end_date = $about->singleAboutDetail ? \Carbon\Carbon::parse($about->singleAboutDetail->end_date)->format('Y-m-d') : '';
                                    @endphp
                                    <div class="form-group">
                                        <label for="joining_date">Joining Date</label>
                                        <input type="date" name="joining_date" id="joining_date" class="form-control"
                                            placeholder="Joining Date" value="{{ $joining_date }}">

                                        <span class="text-danger validate" data-field="joining_date"></span>
                                    </div>
                                    <div class="form-group">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="currently_working-status_e"
                                                name="currently_working_status" value="1"
                                                {{ $about->singleAboutDetail ? ($about->singleAboutDetail->currently_working_status == 1 ? 'checked' : '') : '' }}>
                                            <label for="currently_working-status_e">
                                                Currently Working
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label for="end_date">End Date</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control"
                                                placeholder="End Date" value="{{ $end_date }}">

                                            <span class="text-danger validate" data-field="end_date"></span>
                                        </div>

                                        <div class="form-group">
                                            <label for="description">Descrition</label>
                                            <textarea type="date" name="description" id="description" height="500" class="form-control textarea"
                                                placeholder="Descrition" value=""></textarea>

                                            <span class="text-danger validate" data-field="description"></span>
                                        </div>


                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-block btn-block btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for insert info -->
    <div class="modal fade" id="description_show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header  bg-success">
                    <h5 class="modal-title" id="exampleModalLabel">Info Description For {{ $about->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <div class="card">
                            <div class="card-body">
                                @if ($about->singleAboutDetail)
                                    {!! $about->singleAboutDetail->description !!}
                                @else
                                    <p class="text-danger text-center">Data not found!</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for assign -->
    <div class="modal fade" id="assignNewStack" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="exampleModalLabel">Add Stack For {{ $about->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form id="assignDataStack" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="stack_id">Stack Name</label>
                                        <select name="stack_id[]" id="stack_id" class="select2" multiple data-placeholder="Select Stack">
                                            @foreach ($stacks as $stack)
                                                <option value="{{ $stack->id }}">{{ $stack->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger validate" data-field="stack_id"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="about_id">Name</label>
                                        <select name="about_id" id="about_id" class="select2">
                                            <option value="" selected>Select Name</option>
                                            @foreach ($abouts as $single_about)
                                                <option value="{{ $single_about->id }}" {{ $single_about->id == $about->id ? "selected" : "" }}>{{ $single_about->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger validate" data-field="about_id"></span>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-block btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for insert stack -->
    <div class="modal fade" id="addNewStack" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Stack</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form id="addDataStack" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-body">
                                    <input type="hidden" name="about_card_id" value="{{ $about->id }}">
                                    <div class="form-group">
                                        <label for="logo">Stack Logo</label>
                                        <input type="file" name="logo" id="logo" class="form-control image">

                                        <span class="text-danger validate" data-field="logo"></span>
                                        <div>
                                            <img id="previewImage" width="200" src="" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Stack name</label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Enter Stack Name">

                                        <span class="text-danger validate" data-field="name"></span>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-block btn-primary">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for edit stack -->
    <div class="modal fade" id="editStack" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Stack</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form id="editDataStack" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-body">
                                    <input type="hidden" name="about_card_id" value="{{ $about->id }}">
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                        <label for="logo_e">Stack Logo</label>
                                        <input type="file" name="logo" id="logo_e" class="form-control image">

                                        <span class="text-danger validate" data-field="logo"></span>
                                        <div>
                                            <img id="previewImage_e" width="200" src="" alt="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name_e">Stack name</label>
                                        <input type="text" name="name" id="name_e" class="form-control"
                                            placeholder="Enter Stack Name">

                                        <span class="text-danger validate" data-field="name"></span>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-block btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for insert project -->
    <div class="modal fade" id="addNewProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="exampleModalLabel">Add Project For {{ $about->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form id="addDataProject" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-body">
                                    <input type="hidden" name="about_card_id" value="{{ $about->id }}">
                                    <div class="form-group">
                                        <label for="project_title">Project Title</label>
                                        <input type="text" name="project_title" id="project_title"
                                            class="form-control image" placeholder="Project Title">
                                        <span class="text-danger validate" data-field="project_title"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="short_description">Short Description</label>
                                        <textarea type="text" name="short_description" id="short_description" class="form-control"
                                            placeholder="Enter Short Description"></textarea>

                                        <span class="text-danger validate" data-field="short_description"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date">Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control"
                                            placeholder="Start Date">

                                        <span class="text-danger validate" data-field="start_date"></span>
                                    </div>
                                    <div class="form-group">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="currently_working-status"
                                                name="currently_working_status" value="1">
                                            <label for="currently_working-status">
                                                Present
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label for="end_date">End Date</label>
                                            <input type="date" name="end_date" id="end_date" class="form-control"
                                                placeholder="End Date">

                                            <span class="text-danger validate" data-field="end_date"></span>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-block btn-block btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for edit project -->
    <div class="modal fade" id="editProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Project For {{ $about->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        <form id="editDataProject" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-body">
                                    <input type="hidden" name="about_card_id" value="{{ $about->id }}">
                                    <input type="hidden" name="id" id="id_project">
                                    <div class="form-group">
                                        <label for="project_title_e">Project Title</label>
                                        <input type="text" name="project_title" id="project_title_e"
                                            class="form-control image" placeholder="Project Title">
                                        <span class="text-danger validate" data-field="project_title"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="short_description_e">Short Description</label>
                                        <textarea type="text" name="short_description" id="short_description_e" class="form-control"
                                            placeholder="Enter Short Description"></textarea>

                                        <span class="text-danger validate" data-field="short_description"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date_e">Start Date</label>
                                        <input type="date" name="start_date" id="start_date_e" class="form-control"
                                            placeholder="Start Date">

                                        <span class="text-danger validate" data-field="start_date"></span>
                                    </div>
                                    <div class="form-group">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="currently_working_status_e"
                                                name="currently_working_status" value="1">
                                            <label for="currently_working_status_e">
                                                Present
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label for="end_date_e">End Date</label>
                                            <input type="date" name="end_date" id="end_date_e" class="form-control"
                                                placeholder="End Date">

                                            <span class="text-danger validate" data-field="end_date"></span>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                class="btn btn-block btn-block btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('#description').summernote({
                height: 300 // Set the height in pixels
            });

            $("#logo").change(function(e) {
                e.preventDefault();
                preview(this, "previewImage");
            });

            $("#logo_e").change(function(e) {
                e.preventDefault();
                preview(this, "previewImage_e");
            });


            // dynamic  
            function preview(input, previewId) {
                var selectorIdAndClass = $('#' + previewId);

                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        selectorIdAndClass.removeClass('d-none');
                        selectorIdAndClass.attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert('Select a file to see the preview');
                    selectorIdAndClass.attr('src', '');
                }
            }


            //add info
            $("#addData").submit(function(e) {
                e.preventDefault();
                var formdata = new FormData($("#addData")[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ route('store-about-info') }}",
                    processData: false,
                    contentType: false,
                    data: formdata,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success);
                        } else if (response.error) {
                            toastr.error(response.error);
                        }
                    },
                    error: function(error) {
                        $('.validate').text('');
                        $.each(error.responseJSON.errors, function(field_name, error) {
                            const errorElement = $('.validate[data-field="' +
                                field_name + '"]');
                            if (errorElement.length > 0) {
                                errorElement.text(error[0]);
                                toastr.error(error);
                            }
                        });
                    },

                    complete: function(done) {
                        if (done.status == 200) {
                            window.location.reload();
                        }
                    }

                });
            });

            // for stack assign  
            $("#assignDataStack").submit(function(e) {
                e.preventDefault();
                var formdata = new FormData($("#assignDataStack")[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ route('assign-stack') }}",
                    processData: false,
                    contentType: false,
                    data: formdata,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success);
                        } else if (response.error) {
                            toastr.error(response.error);
                        }
                    },
                    error: function(error) {
                        $('.validate').text('');
                        $.each(error.responseJSON.errors, function(field_name, error) {
                            const errorElement = $('.validate[data-field="' +
                                field_name + '"]');
                            if (errorElement.length > 0) {
                                errorElement.text(error[0]);
                                toastr.error(error);
                            }
                        });
                    },

                    complete: function(done) {
                        if (done.status == 200) {
                            window.location.reload();
                        }
                    }
 
                });
            });

            // for stack  
            $("#addDataStack").submit(function(e) {
                e.preventDefault();
                var formdata = new FormData($("#addDataStack")[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ route('store-stack') }}",
                    processData: false,
                    contentType: false,
                    data: formdata,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success);
                        } else if (response.error) {
                            toastr.error(response.error);
                        }
                    },
                    error: function(error) {
                        $('.validate').text('');
                        $.each(error.responseJSON.errors, function(field_name, error) {
                            const errorElement = $('.validate[data-field="' +
                                field_name + '"]');
                            if (errorElement.length > 0) {
                                errorElement.text(error[0]);
                                toastr.error(error);
                            }
                        });
                    },

                    complete: function(done) {
                        if (done.status == 200) {
                            window.location.reload();
                        }
                    }

                });
            });

            $(".editStack").click(function(e) {
                e.preventDefault();
                $("#id").val($(this).data('stack').id);
                $("#previewImage_e").attr("src", $(this).data('logo'));
                $("#name_e").val($(this).data('stack').name);
            });


            // for stack  update
            $("#editDataStack").submit(function(e) {
                e.preventDefault();
                var formdata = new FormData($("#editDataStack")[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ route('update-stack') }}",
                    processData: false,
                    contentType: false,
                    data: formdata,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success);
                        } else if (response.error) {
                            toastr.error(response.error);
                        }
                    },
                    error: function(error) {
                        $('.validate').text('');
                        $.each(error.responseJSON.errors, function(field_name, error) {
                            const errorElement = $('.validate[data-field="' +
                                field_name + '"]');
                            if (errorElement.length > 0) {
                                errorElement.text(error[0]);
                                toastr.error(error);
                            }
                        });
                    },

                    complete: function(done) {
                        if (done.status == 200) {
                            window.location.reload();
                        }
                    }

                });
            });


            // for project  add
            $("#addDataProject").submit(function(e) {
                e.preventDefault();
                var formdata = new FormData($("#addDataProject")[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ route('store-project-for-employee') }}",
                    processData: false,
                    contentType: false,
                    data: formdata,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success);
                        } else if (response.error) {
                            toastr.error(response.error);
                        }
                    },
                    error: function(error) {
                        $('.validate').text('');
                        $.each(error.responseJSON.errors, function(field_name, error) {
                            const errorElement = $('.validate[data-field="' +
                                field_name + '"]');
                            if (errorElement.length > 0) {
                                errorElement.text(error[0]);
                                toastr.error(error);
                            }
                        });
                    },

                    complete: function(done) {
                        if (done.status == 200) {
                            window.location.reload();
                        }
                    }

                });
            });

            $(".editProject").click(function(e) {
                e.preventDefault();

                $("#id_project").val($(this).data('project').id);
                $("#project_title_e").val($(this).data('project').project_title);
                $("#short_description_e").val($(this).data('project').short_description);
                $("#start_date_e").val($(this).data('start'));
                $("#currently_working_status_e").attr("checked",$(this).data('checked'));
                $("#end_date_e").val($(this).data('end'));
            });

            // for project  update
            $("#editDataProject").submit(function(e) {
                e.preventDefault();
                var formdata = new FormData($("#editDataProject")[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ route('update-project-for-employee') }}",
                    processData: false,
                    contentType: false,
                    data: formdata,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.success);
                        } else if (response.error) {
                            toastr.error(response.error);
                        }
                    },
                    error: function(error) {
                        $('.validate').text('');
                        $.each(error.responseJSON.errors, function(field_name, error) {
                            const errorElement = $('.validate[data-field="' +
                                field_name + '"]');
                            if (errorElement.length > 0) {
                                errorElement.text(error[0]);
                                toastr.error(error);
                            }
                        });
                    },

                    complete: function(done) {
                        if (done.status == 200) {
                            window.location.reload();
                        }
                    }

                });
            });
        });
    </script>
@endsection
