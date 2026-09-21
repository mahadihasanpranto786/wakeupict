@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Users List
@endsection
{{-- menu active start --}}
@section('user_active', 'menu-open')

@section('menu_active_user', 'active')

@section('user_list_list', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Users List
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">


                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Profile Photo</th>
                                        <th>User Info</th>
                                        <th>Salary Info</th>
                                        <th>Type</th>


                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($users as $user)
                                        <tr>
                                            <td> {{ $serial++ }}</td>
                                            <td>
                                                @if ($user->photo == null)
                                                    <img class="profile-user-img img-fluid img-circle"
                                                        src="{{ URL::asset('uploads/profile/demo.jpg') }}"
                                                        alt="User profile picture">
                                                @else
                                                    <img type="button" data-toggle="modal"
                                                        data-target="#userPhoto{{ $user->id }}"
                                                        class="profile-user-img img-fluid img-circle"
                                                        src="{{ URL::asset($user->photo) }}" alt="User profile picture">
                                                @endif
                                            </td>
                                            <td>
                                                <strong> Name:</strong> {{ $user->name }} <br>
                                                <strong> Employee Type:</strong> {{ $user->employee_type }} <br>
                                                <strong>Email:</strong> {{ $user->email }} <br>
                                                <strong>NID:</strong> {{ $user->nid_number }} <br>

                                                @if (!empty($user->designation->designation_name))
                                                    <strong>Designation:</strong>
                                                    {{ $user->designation->designation_name }}
                                                @endif

                                                <br>
                                            </td>
                                            <td>
                                                @php
                                                    $totalSalaryTook = App\model\Payroll::where([
                                                        'user_id' => $user->id,
                                                        'status' => 1,
                                                        'type' => 'Salary',
                                                    ])->sum('amount');
                                                    $totalSalaryTimes = App\model\Payroll::where([
                                                        'user_id' => $user->id,
                                                        'status' => 1,
                                                        'type' => 'Salary',
                                                    ])->count();
                                                    $totalBonusTook = App\model\Payroll::where([
                                                        'user_id' => $user->id,
                                                        'status' => 1,
                                                        'type' => 'Bonus',
                                                    ])->sum('amount');
                                                    $totalBonusTimes = App\model\Payroll::where([
                                                        'user_id' => $user->id,
                                                        'status' => 1,
                                                        'type' => 'Bonus',
                                                    ])->count();
                                                    
                                                @endphp
                                                <strong> Total Salary Took:</strong> {{ $totalSalaryTook }} Tk<br>
                                                <strong>Salary Times:</strong>
                                                {{ $totalSalaryTimes }}{{ $totalSalaryTimes != 1 ? ' times' : ' time' }}
                                                <br>
                                                <strong>Total Bonus Took:</strong> {{ $totalBonusTook }} Tk<br>
                                                <strong>Bonus Times:</strong>
                                                {{ $totalBonusTimes }}{{ $totalBonusTimes != 1 ? ' times' : ' time' }}<br>

                                                <br>
                                            </td>
                                            <td>{{ $user->type }} </td>


                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="userPhoto{{ $user->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">

                                                        <img class="card-img-top" src="{{ URL::asset($user->photo) }}"
                                                            alt="{{ $user->name }}'s Photo">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="float-right m-3">
                            {{ $users->links() }}
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
