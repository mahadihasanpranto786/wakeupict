@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    User Excess Module
@endsection

{{-- menu active start --}}
@section('active_sms', 'menu-open')

@section('menu_active', 'active')

@section('user_list_list', 'active')
{{-- menu active end --}}

@section('maincontant')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header p-2">
                    <h3 class="card-title p-2">
                        Submit User Excess
                    </h3>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-body">
                            <h4><strong class=""> User Name:</strong> {{ $user->name }}</h4>
                        </div>
                        <form action="{{ route('user_excess') }}" method="POST">
                            @csrf
                            <div class="mt-1">
                                @foreach ($modules as $item)
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <ul>
                                        <div class="icheck-success d-inline">
                                            <input type='checkbox' parent="parent" data-id='{{ $item->id }}'
                                                id="check{{ $item->id }}" name="module_id[]"
                                                value="{{ $item->id }}">
                                            <label for="check{{ $item->id }}">
                                                {{ $item->title }}
                                            </label>
                                            <ul>
                                                @php
                                                    $subModules = App\model\Module::where('parents', $item->id)
                                                        ->where('orgine', $item->id)
                                                        ->where('status', 1)
                                                        ->get();
                                                    // print_r($subModules);
                                                    // die();
                                                @endphp

                                                <div class="submodule d-none">
                                                    @foreach ($subModules as $sub)
                                                        @php
                                                            $subsubModules = App\model\Module::where('parents', $sub->id)
                                                                ->where('orgine', $item->id)
                                                                ->where('status', 1)
                                                                ->get();
                                                        @endphp
                                                        <li class="list-group">
                                                            <div class="icheck-success d-inline">
                                                                <input type='checkbox' parent="submodule"
                                                                    id="subcheck{{ $sub->id }}" name="module_id[]"
                                                                    value="{{ $sub->id }}">
                                                                <label for="subcheck{{ $sub->id }}">
                                                                    {{ $sub->title }}
                                                                </label>
                                                                @foreach ($subsubModules as $subsub)
                                                                    <ul class='subsubmodule d-none'>
                                                                        <li class="list-group">
                                                                            <div class="icheck-success d-inline">
                                                                                <input type='checkbox' parent="subsubmodule"
                                                                                    id="subsubcheck{{ $subsub->id }}"
                                                                                    name="module_id[]"
                                                                                    value="{{ $subsub->id }}">
                                                                                <label
                                                                                    for="subsubcheck{{ $subsub->id }}">
                                                                                    {{ $subsub->title }}
                                                                                </label>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                @endforeach
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </div>
                                            </ul>
                                        </div>
                                    </ul>
                                @endforeach
                            </div>
                            <div class="form-group my-4">
                                <button type="submit" class="btn btn-success col-md-6 offset-3">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <!-- /.card -->
                        <div class="card-body">
                            <div class="card-header">
                                <div><strong class=""> User Excess Module List </strong></div>
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>User Excess</th>
                                        <th>Module Name</th>
                                        <th>
                                            <a href="{{ url('delete-all-excess/' . $user->id) }}"
                                                class="btn btn-danger ml-auto">Delete All</a>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $serial = 1;
                                        // dd($users);
                                    @endphp
                                    @foreach ($user_roll as $excess)
                                        <tr>
                                            <td> {{ $serial++ }}</td>

                                            <td>{{ $excess->module->title }} </td>
                                            <td>
                                                @if ($excess->module->parents == 0 && $excess->module->orgine == 0)
                                                    Module
                                                @elseif ($excess->module->orgine == $excess->module->parents && $excess->module->orgine != 0)
                                                    Sub Module
                                                @else
                                                    Sub Sub Module
                                                @endif
                                            </td>
                                            <td class="border">
                                                <div>
                                                    {{-- delete --}}
                                                    <button title="Delete" class="btn btn-danger btn-sm"><a
                                                            class="flex items-center "
                                                            href="{{ url('delete_user_excess/' . $excess->id) }}"><i
                                                                class="fas fa-trash  text-white"></i></a>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="m-1 float-right">
                                {{ $user_roll->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
    </div>
    <!-- jQuery -->

    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('[parent="parent"]').click(function() {
                if ($(this).is(':checked') == true) {
                    $(this).siblings().find('.submodule').fadeIn(1000).attr('class', 'submodule');
                    $(this).parentsUntil().find('[parent="submodule"]').click(function() {
                        if ($(this).is(':checked') == true) {
                            $(this).closest('li').find('.subsubmodule').fadeIn(1000).attr('class',
                                'subsubmodule');
                        } else if ($(this).is(':checked') == false) {
                            $(this).closest('li').find('.subsubmodule').fadeOut(1000).attr('class',
                                'subsubmodule d-none');
                        }
                    })
                } else if ($(this).is(':checked') == false) {
                    $(this).siblings().find('.submodule').fadeOut(1000).attr('class',
                        'submodule d-none');

                }
            });
        })
    </script>
@endsection
