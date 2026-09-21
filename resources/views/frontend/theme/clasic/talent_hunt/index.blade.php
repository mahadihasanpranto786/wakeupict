@extends('frontend.theme.clasic.frontend_layouts.master_layout')
@section('title')
    {{ $post->title ?? '' }}
@endsection
@section('maincontent')
    @if ($post->status == 1)
        <!--========================== Services Section ============================-->
        <section class="pt-5 mt-5">
            <div class="py-4 container">
                <h1 class="mb-3 text-center">{{ $post->title ?? '' }}</h1>
                <hr class="my-4">
            </div>
        </section>

        <section class="course__details">
            <div class="container">
                <div class="course__details__need mb-5">
                    <p>{!! $post->description ?? '' !!}</p>
                </div>
            </div>
        </section>
    @endif
@endsection
