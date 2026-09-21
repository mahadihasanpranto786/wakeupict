@extends('backend.theme.clasic.home.footer.footer_index')

@section('footerSection')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title text-center">Insert Footer Content</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form" method="POST" action="{{ route('store_footer') }}">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="footer_header">Footer Header</label>
                    <input class="form-control" id="footer_header" name="footer_header" type="text"
                        placeholder="Enter Footer Header" data-validation='required' value="{{ old('footer_header') }}">
                </div>
                <div class="form-group">
                    <label for="footer_content">Footer Content</label>
                    <textarea class="form-control" id="footer_content" name="footer_content" type="text"
                        placeholder="Enter Footer Content" data-validation='required'
                        value="{{ old('footer_content') }}"></textarea>
                </div>

                <div class="form-group">
                    <p class="text-danger">Note: Footer Background Image size must be (1920 x 500)</p>
                    <label for="footer_backgroud">Footer Background Image</label>
                    <input class="form-control" id="footer_backgroud" name="footer_backgroud" type="file"
                        data-validation='required' value="{{ old('footer_backgroud') }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary align-top">
                        Insert</button>
                </div>
            </div>
        </form>
    </div>

@endsection
