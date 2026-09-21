@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Employee Leave Application
@endsection
{{-- menu active start --}}
@section('leave_active', 'menu-open')

@section('employee_leave', 'active')

@section('leave_menu_active', 'active')
{{-- menu active end --}}

@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Employee Leave Application
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10  border border-info my-2">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    @php
                                                        $totalLeaves = 0;
                                                        foreach ($leaves as $item) {
                                                            $totalLeaves += (int) $item->leave_days;
                                                        }
                                                        $leaveTaken = App\model\LeaveTaken::where('created_by', Auth::id())->sum('leave_taken');
                                                    @endphp
                                                    <!-- ./col -->
                                                    <div class="col-lg-8 mt-2">
                                                        <!-- small box -->
                                                        <div class="small-box bg-success">
                                                            <div class="inner text-center">
                                                                <h3>{{ $totalLeaves }} Days</h3>

                                                                <p>Total Leaves For You</p>
                                                            </div>
                                                            <div class="icon">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    @foreach ($leaves as $day)
                                                        <td>
                                                            {{ $day->category_name }}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    @foreach ($leaves as $day)
                                                        <td>
                                                            {{ $day->leave_days }} Days
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-10  border border-info my-2">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <div class="row">
                                                        <div class="col-md-8  mt-2">
                                                            <div class="small-box bg-primary">
                                                                <div class="inner text-center">
                                                                    <h3>{{ $leaveTaken }} Days</h3>

                                                                    <p>Total Leaves You had Taken</p>
                                                                </div>
                                                                <div class="icon">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2  mt-1">
                                                            <div class="small-box bg-success" style="border-radius: 50%;">
                                                                <div class="inner text-center">
                                                                    <h1>50%</h1>
                                                                    <P>Approved</P>
                                                                </div>
                                                                <div class="icon">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <tr>
                                                    @foreach ($leaves as $day)
                                                        <td>
                                                            {{ $day->category_name }}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    @foreach ($leaves as $day)
                                                        @php
                                                            $leaveTaken = App\model\LeaveTaken::where('leave_category_id', $day->id)->sum('leave_taken');
                                                        @endphp
                                                        <td>
                                                            @if (!empty($leaveTaken))
                                                                @if ($leaveTaken == 1)
                                                                    {{ $leaveTaken }} Day
                                                                @else
                                                                    {{ $leaveTaken }} Days
                                                                @endif
                                                            @else
                                                                0 Days
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="my-1">
                    <div class="float-right">
                        @if (Auth::user()->type == 'Admin')
                            <a class="btn btn-primary mx-3" href="{{ URL::to('apply_employee_leave') }}"><i
                                    class="fas fa-plus-circle"></i>Apply for Leave</a>
                        @endif
                    </div>
                </div>
                <div class="m-4">
                    <div class="row">
                        <div class="col-md-7 border border-info">
                            <div class="card-body">
                                <div class="modal-body">
                                    <div class="card ">
                                        <div class="card-header">
                                            Details of your Leaves list
                                        </div>
                                        <!-- form start -->
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>SL</th>
                                                    <th>Name</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Phone</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php
                                                    $serial = 1;
                                                @endphp
                                                @foreach ($LeaveApplications as $application)
                                                    <tr>
                                                        <td> {{ $serial++ }}</td>
                                                        <td>{{ Auth::user()->name }} </td>
                                                        <td>{{ $application->start_date }}</td>
                                                        <td>{{ $application->end_date }} </td>
                                                        <td>{{ $application->phone }}</td>
                                                        <td>
                                                            <span
                                                                class="badge badge-{{ $application->approve_status == 0 ? 'danger' : 'primary' }}">
                                                                {{ $application->approve_status == 0 ? 'Pending' : 'Approved' }}
                                                            </span>
                                                        </td>
                                                        {{-- <td>
                                            <div class="d-flex"> --}}

                                                        {{-- edit --}}
                                                        {{-- <button type="button"
                                                    class="btn btn-sm btn-primary editCategory"
                                                    data-toggle="modal"
                                                    data-target="#editLeaveCategory"> <i
                                                        class="fas fa-pencil-alt text-white text-white"></i>
                                                </button> --}}
                                                        {{-- delete --}}
                                                        {{-- <a title="Delete Application"
                                                    class="btn btn-danger btn-sm" id="delete"
                                                    href="{{ url('delete-leave-application/' . $application->id) }}"><i
                                                        class="fas fa-trash  text-white"></i>
                                                </a> --}}
                                                        {{-- delete --}}
                                                        {{-- <a title="Delete Application"
                                                    class="btn btn-success btn-sm"
                                                    href="{{ url('print-application/' . $application->id) }}"><i
                                                        class="fas fa-eye  text-white"></i>
                                                </a>

                                            </div> --}}
                                                        {{-- @if (Auth::user()->type == 'Admin') --}}
                                                        {{-- delete --}}
                                                        {{-- @if ($application->approve_status == 0)
                                                    <a style="padding: 5px 23px 5px 23px;"
                                                        title="Delete Application"
                                                        class="btn btn-primary btn-sm mt-1"
                                                        href="{{ url('approve-application/' . $application->id) }}">
                                                        Approve
                                                    </a>
                                                @else

                                                    <a style="padding: 5px 32px 5px 32px;"
                                                        title="Delete Application"
                                                        class="btn btn-danger btn-sm mt-1"
                                                        href="{{ url('deny-application/' . $application->id) }}">
                                                        Deny
                                                    </a>
                                                @endif
                                            @endif --}}


                                                        {{-- </td> --}}
                                                    </tr>
                                                @endforeach
                                                {{ $LeaveApplications->links() }}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5  border border-info border-left-0">
                            <P>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis, recusandae?
                            </P>
                            <P>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis, recusandae?
                            </P>
                            <P>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis, recusandae?
                            </P>
                            <P>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis, recusandae?
                            </P>
                            <P>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis, recusandae?
                            </P>
                            <P>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis, recusandae?
                            </P>
                            <P>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis, recusandae?
                            </P>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>

@endsection
