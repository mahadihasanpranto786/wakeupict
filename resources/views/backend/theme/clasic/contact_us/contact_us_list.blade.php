@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Contact Us Lists
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('contact_page', 'menu-open')

@section('menu_active_contact', 'active bg-info')

@section('contact_list_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Lists</h3>
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Enail</th>
                                        <th>Website</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($contacts as $contact)
                                        <tr>
                                            <td> {{ $serial++ }}</td>
                                            <td>
                                                <img width="100" src="{{ URL::asset($contact->image) }}"
                                                    alt="contact man image">
                                            </td>
                                            <td>{{ $contact->name }}
                                            </td>
                                            <td>{{ $contact->phone }}
                                            </td>
                                            <td>{{ $contact->email }}
                                            </td>
                                            <td>{!! $contact->message !!}
                                            </td>
                                            <td class="d-flex">
                                                {{-- view --}}

                                                <button title="View" class="btn btn-primary btn-sm"> <a
                                                        class="flex items-center "
                                                        href="{{ url('view-contact/' . $contact->id) }}"><i
                                                            class="fas fa-eye text-white"></i>
                                                    </a>
                                                </button>

                                                @if (checkUserType() == 0)
                                                    {{-- delete --}}
                                                    <button title="Delete" class="btn btn-danger btn-sm"><a
                                                            class="flex items-center " id="delete"
                                                            href="{{ url('delete-contact/' . $contact->id) }}"><i
                                                                class="fas fa-trash  text-white"></i></a>
                                                    </button>
                                                @endif
                                            </td>
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
@endsection
