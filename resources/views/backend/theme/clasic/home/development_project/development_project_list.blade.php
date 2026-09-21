@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Development Project List
@endsection
{{-- menu active start --}}

@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('home_page', 'menu-open')

@section('menu_active_home', 'active bg-info')

@section('project_active', 'active')
{{-- menu active end --}}

@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Development Projet</h3>
                    @if (checkUserType() == 0)
                        <a class="float-right" href="{{ route('add-development-project') }}">
                            <button class="btn btn-primary  align-top"><i class="fas fa-plus-circle"></i>
                                Add Development Project</button>
                        </a>
                    @endif
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="my-2">
                                <!-- Button trigger modal -->
                                @if (checkUserType() == 0)
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#development_header">
                                        Update Header
                                    </button>
                                @endif
                            </div>

                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Image Alt</th>
                                        <th>Logo</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        @if (checkUserType() == 0)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($projects as $project)
                                        <tr>
                                            <td> {{ $serial++ }}</td>
                                            <td>
                                                <img width="100px" src="{{ URL::asset($project->image) }}"
                                                    alt="project image">
                                            </td>
                                            <td>{{ $project->title }}
                                            </td>
                                            <td>{{ $project->image_alt }}
                                            </td>
                                            <td><i class="{{ $project->logo }}"></i>
                                            </td>
                                            <td>
                                                {!! $project->description !!}
                                            </td>


                                            <td>
                                                @if ($project->active_project == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @else
                                                    <span class="badge bg-danger">Inactive</span>
                                                @endif
                                            </td>
                                            @if (checkUserType() == 0)
                                                <td class="d-flex">
                                                    {{-- status --}}
                                                    @if ($project->active_project == 1)
                                                        <button title="Inactive" class="btn btn-danger btn-sm"> <a
                                                                class="flex items-center "
                                                                href="{{ 'project-inactive/' . $project->id }}"> <i
                                                                    class="fas fa-arrow-circle-down text-white"></i></a></button>
                                                    @else
                                                        <button title="Active" class="btn btn-success btn-sm"> <a
                                                                class="flex items-center "
                                                                href="{{ 'project-active/' . $project->id }}"> <i
                                                                    class="fas fa-arrow-circle-up text-white"></i></a></button>
                                                    @endif
                                                    {{-- edit --}}
                                                    <button title="Edit" class="btn btn-primary btn-sm"> <a
                                                            class="flex items-center "
                                                            href="{{ 'project-edit/' . $project->id }}"><i
                                                                class="fas fa-pencil-alt text-white"></i>
                                                        </a>
                                                    </button>


                                                    {{-- delete --}}
                                                    <button title="Delete" class="btn btn-danger btn-sm"><a
                                                            class="flex items-center " id="delete"
                                                            href="{{ 'delete-project/' . $project->id }}"><i
                                                                class="fas fa-trash  text-white"></i></a>
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

    <!-- Modal -->
    <div class="modal fade" id="development_header" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="exampleModalLabel">Update Header of Development Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('development-project-header-update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $developmentProjectHeader->id }}">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <button type="button" style="float: right; border-radius: 3px;" class="btn-success"
                                data-toggle="modal" data-target=".developmentProjecHeaderTitle">Preview
                            </button>
                            <input type="text" class="form-control" name="title" placeholder="Title" id="title"
                                value="{{ $developmentProjectHeader->title }}">
                        </div>

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <label for="description">Description</label>
                            <button type="button" style="float: right; border-radius: 3px;" class="btn-success"
                                data-toggle="modal" data-target=".developmentProjectHeaderDescription">Preview
                            </button>
                            <textarea type="text" class="form-control textarea" id="description" name="description"
                                placeholder="Description">{{ $developmentProjectHeader->description }}</textarea>
                        </div>

                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('backend/theme/clasic/include/modal_photos/modal')

@endsection
