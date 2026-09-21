@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Multiple Expense List
@endsection
{{-- menu active start --}}
@section('expense', 'menu-open')

@section('expense_active', 'active bg-info')

@section('account', 'menu-open')

@section('menu_active', 'active')

@section('multiple_expense_active', 'active')
{{-- menu active end --}}


@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Multiple Expense List</h3>
                </div>
                @php
                    $Add_Multiple_Expense = 0;
                    $Delete_Multiple_Expense = 0;
                    foreach (userRolls() as $roll) {
                        if ($roll->module_id == 23) {
                            $Add_Multiple_Expense = 23;
                        } elseif ($roll->module_id == 70) {
                            $Delete_Multiple_Expense = 70;
                        }
                    }
                @endphp
                <!-- /.card-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-body">
                            <div class="my-2">
                                @if ((checkUserType() == 0 && $Add_Multiple_Expense != 0) || Auth::user()->type == 'Admin')
                                    <a href="{{ route('add-multiple-expense') }}">
                                        <button class="btn btn-primary  align-top"><i class="fas fa-plus-circle"></i> Add
                                            Multiple
                                            Expense</button>
                                    </a>
                                @endif
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Category</th>
                                        <th>Date</th>
                                        @if (checkUserType() == 0)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($multiExpenses as $expense)
                                        <tr>
                                            @php
                                                
                                                $myCategories = explode(',', $expense->category_id);
                                                $total = count($myCategories) - 1;
                                                $category = '';
                                                for ($i = 0; $i < $total; $i++) {
                                                    $category .= App\model\AccountCategory::where('id', $myCategories[$i])->value('title') . ', ';
                                                }
                                            @endphp
                                            <td> {{ $serial++ }}</td>
                                            <td>{{ $category }}</td>
                                            <td>{{ Carbon\Carbon::parse($expense->date)->format('d F, Y') }} </td>

                                            @if (checkUserType() == 0)
                                                <td>
                                                    <div class="d-flex">
                                                        {{-- edit --}}
                                                        {{-- <button title="Edit expense" class="btn btn-primary btn-sm">
                                                        <a href="{{ url('edit-multiple-expense/' . $expense->id) }}"> <i
                                                                class="fas fa-pencil-alt text-white"></i>
                                                        </a></button> --}}
                                                        {{-- delete --}}
                                                        @if ((checkUserType() == 0 && $Delete_Multiple_Expense != 0) || Auth::user()->type == 'Admin')
                                                            <button title="Delete expense" class="btn btn-danger  btn-sm"><a
                                                                    id="delete"
                                                                    href="{{ url('delete-multiple-expense/' . $expense->id) }}"><i
                                                                        class="fas fa-trash  text-white"></i></a>
                                                            </button>
                                                        @endif

                                                        <a href="{{ url('expense-multiple-print/' . $expense->id) }}"><i
                                                                class="fas fa-eye  text-white btn btn-success  btn-sm"></i></a>

                                                    </div>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    {{ $multiExpenses->links() }}
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
