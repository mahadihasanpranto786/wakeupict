@extends('frontend.theme.clasic.frontend_layouts.master_layout')
{{-- @foreach ($page_content as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach --}}

@section('maincontent')


    <!--========================== Services Section ============================-->
    <section class="pt-5 mt-5">
        <div class="py-4 container">
            <h2 class="text-center">ধন্যবাদ <b class="text-success">{{ $student_name }}</b></h2>
            <h2 class="text-center text-info">আপনার আবেদন সম্পন্ন হয়েছে।</h2>
            <h2 class="text-center text-success">পরবর্তিতে আপনার ভর্তির বিষয়ে জানানো হবে।</h2>
        </div>
    </section>


@endsection
