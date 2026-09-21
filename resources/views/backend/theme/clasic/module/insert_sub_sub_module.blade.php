@extends('backend.theme.clasic.module.module_index')

@section('moduleSection')
    <div class="my-2">
        <h4 class="text-center font-weight-bold">Insert Sub Sub Module</h4>
        <form role="form" method="POST" action="{{ route('store_update_sub_sub_module') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="form-group">
                <label>Module</label>
                <select id="module_id" name="orgine" class="form-control select2" style="width: 100%;">
                    <option selected="selected">Select Module</option>
                    @foreach ($parent_modules as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->title }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label>Sub Module</label>
                <select name="parents" class="form-control select2" style="width: 100%;">
                    <option selected="selected">Select Sub Module</option>

                </select>
            </div>
            <div class="form-group">
                <label for="title">Sub Sub Module </label>
                <input required type="text" name="title" class="form-control" placeholder="Enter Sub Sub Module">
                @error('title')
                    <span class="text-danger">{{ $massage }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
        </form>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('public/admin/plugins/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#module_id').on('change', function() {
                var parent_id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                function subModule_data() {
                    if (parent_id) {
                        $.ajax({
                            method: 'GET',
                            datatype: "json",
                            url: "{{ url('/sub_module_ajax') }}/" + parent_id,

                            success: function(data) {
                                var district = $('select[name="parents"]').html('');
                                var d = $('select[name="parents"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="parents"]').append(
                                        '<option  value="' + value.id + '">' + value
                                        .title + '</option>');
                                });

                            },
                            error: function() {
                                console.log('error');
                            }
                        })
                    }
                }
                subModule_data();
            });
        });
    </script>
@endsection
