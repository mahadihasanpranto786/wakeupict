@extends('backend.theme.clasic.admin_layouts.admin-master')
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
                                    <tr class="text-center">
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>order</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>

                                <tbody id="tableData">
                                    @php
                                        $serial = 1;
                                    @endphp
                                    @foreach ($testData as $test)
                                        <tr class="rowSort" id="{{ $test->id }}">
                                            <td> {{ $serial++ }}</td>
                                            <td class="text-center">{{ $test->name }}</td>
                                            <td class="text-center">{{ $test->order }}</td>
                                            <td class="text-center">{{ $test->status == 1 ? 'active' : 'inactive' }}
                                            </td>
                                            <td class="text-center">{{ $test->date }}</td>
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
    </div>

    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('public/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $('#tableData').sortable({
            items: 'tr',
            cursor: 'move',
            opacity: 0.60,
            update: function() {
                sortingFunction();
            }
        });

        function sortingFunction() {
            var order = [];
            // var token = $('meta[name="csrf-token"]').attr('content');
            $('tr.rowSort').each(function(index, value) {
                order.push({
                    id: $(this).attr('id'),
                    position: index + 1,
                });
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                datatype: 'json',
                url: "{{ url('text_sorting') }}",
                data: {
                    order: order
                },

                success: function(data) {
                    if (data.status == "success") {
                        console.log(data);
                    } else {
                        console.log(data);
                    }
                }
            });
        }
    </script>
@endsection
