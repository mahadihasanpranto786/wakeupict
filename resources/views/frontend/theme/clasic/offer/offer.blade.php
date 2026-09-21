@extends('frontend.theme.clasic.frontend_layouts.master_layout')
{{-- @foreach ($content_list as $content)
    @include('frontend.theme.clasic.include.seo')
@endforeach --}}
@section('maincontent')

    <canvas class="canvas"></canvas>

    <section id="offerHeader"
        class="offer__background jumbotron jumbotron-fluid text-white d-flex justify-content-center align-items-center mt-5"
        style="background-image: url(' {{ URL::asset('frontend/image/offer-bg.png') }}');">
        <div class="container text-center mt-5">
            <div class="offer__detail_head header-background p-4">
                <h2 class="text-uppercase ex2">Wake Up ICT</h2>
                <p class="d-none d-sm-block text-uppercase ex1">A prominent software firm in Rajbari. Get in touch with us
                    for more details</p>
                <h2></h2>
            </div>
        </div>
    </section>

    <section class="offer__details">
        <div class="container " style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div class="row bg-white">
                <div class="offer__details__content">
                    <div class="offer__details__content__header mb-5">
                        <h3 class="text-center"><span style="color: #b0282a; font-size: 40px"> ~ </span> ফ্রী <span
                                style="color: #b0282a;"> Microsoft Office Program course</span> এ অংশগ্রহন করুন <span
                                style="color: #b0282a; font-size: 40px"> ~ </span></h3>
                        <hr>
                    </div>
                    <div class="offer__details__content__dec mb-5 js-slidein block">
                        <div class="offer__details__rules mb-3">
                            <blockquote class="blockquote">
                                <h6 class="mb-3">শর্তাবলী</h6>
                            </blockquote>
                        </div>
                        <ol>
                            <li class="mb-3">আমাদের ফেসবুক পেজ টি লাইক এবং ফলো করুন।</li>
                            <li class="mb-3">আমাদের ফেসবুক পেজ এ কমপক্ষে ১০০ জনকে ইনভাইট করুন। </li>
                            <li class="mb-3">আমাদের অফার পোস্ট এর কমেন্টে কমপক্ষে ২০ জন কে মেনশন করুন।</li>
                            <li class="mb-3">আমাদের ফেসবুকের অফার পোস্ট টি আপনার ফেসবুক প্রোফাইলে শেয়ার করুন ।
                            </li>
                            <li class="mb-3">ইনভাইট করার সময় কমপক্ষে ১০০ জনকে সিলেক্ট করে স্ক্রীনশট সহ আপনার
                                ফেসবুক প্রোফাইল লিংক টি আমদের পেজ এ ম্যাসেজ করুন।</li>
                            <li class="mb-3">যার ইনভাইট এর মাধ্যমে আমাদের পেজ এ বেশি লাইক এবং ফলোয়ার নিয়ে আসবে তার
                                বিজয়ী হওয়ার সম্ভাবনা বেশী থাকবে।</li>
                        </ol>
                    </div>
                    <hr>
                    <div class="offer__details__content__social mb-5 js-slidein block">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-sm-6">
                                <div class="offer__details__content__social--facebook">
                                    <p><a href="https://www.facebook.com/wakeupict/" target="_blank"
                                            class="___class_+?27___"><i class="fa fa-facebook-square"
                                                aria-hidden="true"></i> Find Us On Facebook</a> </p>
                                </div>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                    <hr>

                    <div class="offer__details__content__dec js-slidein block">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="offer__details__time mb-5">
                                    <blockquote class="blockquote">
                                        <h6 class="mb-3">প্রতিযোগিতায় অংশগ্রহণের সময়সীমা ২৫ শে সেপ্টেম্বর
                                            পর্যন্ত।</h6>
                                    </blockquote>
                                </div>

                                <p class="mb-5">যার ইনভাইট কার্যক্রম আমাদের পেজ এ বেশি লাইক এবং ফলোয়ার নিয়ে আসবে
                                    তাকে প্রথম বিজয়ী হিসেবে নির্ধারণ করা হবে। এবং দ্বিতীয় বিজয়ী কে লটারির মাধ্যমে নির্ধারণ
                                    করা হবে।
                                    আপনার সকল কার্যক্রম আমাদের IT Expert টিম দ্বারা মনিটরিং করা হবে সুতরাং উপরিউক্ত কোন একটি
                                    শর্তাবলী ও যদি কেউ বাদ রাখে তাহলে সে প্রতিযোগী হিসেবে গন্য হবে না।
                                </p>
                                <div class="offer__details__gift mb-5">
                                    <blockquote class="blockquote">
                                        <h6 class="mb-3">পুরস্কার সমুহ:</h6>
                                    </blockquote>
                                </div>

                                <ol>
                                    <li class="mb-3 h5"> Microsoft Office Program course (Include Certificate) and
                                        T-Shirt. <img src="{{ URL::asset('frontend/image/check-circle.gif') }}"
                                            height="20px" width="20px" alt=""></li>
                                    <li class="mb-3 h5"> Microsoft Office Program course (Include Certificate) <img
                                            src="{{ URL::asset('frontend/image/check-circle.gif') }}" height="20px"
                                            width="20px" alt=""></li>
                                </ol>
                            </div>
                            <div class="col-sm-4 text-center">
                                <img src="{{ URL::asset('frontend/image/Offer-Post-gifts.jpg') }}" class="img-fluid"
                                    alt="">
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </section>

    <section class="offer__game">
        <div class="puzzle" id="puzzle"></div>
    </section>



@endsection
