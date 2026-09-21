<!--========================== Get In touch ============================-->
@php
$footer = App\model\FooterContent::where('status', 1)
    ->where('active_status', 1)
    ->first();
@endphp
@if (!empty($footer))
    <section id="get_in_touch_bottom" style="background-image: url('{{ URL::asset($footer->footer_backgroud) }}')"
        class="bg-secondary">
        <div class="text-center py-5 text-white get_in_touch_bottom--back">
            <h1>{{ $footer->footer_header }}</h1>
            <p class="mb-5">{{ $footer->footer_content }}</p>
            <a href="{{ route('contact-us-page') }}" class="btn btn-outline-light my-3">Contact Us Now</a>
        </div>
    </section>
@endif

<!--========================== Footer ============================-->
<footer id="footer" class="footer-1">
    <div class="main-footer widgets-dark typo-light">
        <div class="container">
            <div class="row">

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="widget subscribe no-box">
                        <h5 class="widget-title">Wake Up ICT<span></span></h5>
                        <p>We shape technology that inspires people and grow business....</p>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="widget no-box">
                        <h5 class="widget-title">Quick Links<span></span></h5>
                        <ul class="thumbnail-widget">
                            <li>
                                <div class="thumb-content"><a href="{{ route('about-page') }}" class="text-white">About
                                        Us</a>
                                </div>
                            </li>
                            <li>
                                <div class="thumb-content"> <a href="{{ route('services-page') }}"
                                        class="text-white">Services</a>
                                </div>
                            </li>
                            <li>
                                <div class="thumb-content"><a href="{{ route('our-blogs') }}" class="text-white">Our
                                        Blogs</a>
                                </div>
                            </li>

                            <li>
                                <div class="thumb-content"><a href="{{ route('contact-us-page') }}"
                                        class="text-white">Contact</a></div>
                            </li>
                            <li>
                                <div class="thumb-content"><a href="{{ route('login') }}" class="text-white">Login</a>
                                </div>
                            </li>
                            <li>
                                <div class="thumb-content"><a href="{{ route('register') }}"
                                        class="text-white d-none">Register</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-3">
                    <div class="widget no-box">
                        <h5 class="widget-title">Get Started<span></span></h5>
                        <p>The best service you can get.</p>
                        <a href="{{ route('contact-us-page') }}" class="f_btn my-2">Get started</a>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-3">

                    <div class="widget no-box">
                        <h5 class="widget-title">Contact Us<span></span></h5>
                        <p>Address: Nannu Tower, 2nd Floor, Panna Chatter, Rajbari.</p>
                        <p>Mail: <a href="mailto:info@wakeupict.com" title="glorythemes">info@wakeupict.com</a></p>
                        <p>Phone: <a href="tel:+8801791612121" title="glorythemes">+88 01791612121</a></p>
                        <ul class="social-footer2">
                            <li>
                                <a href="https://www.facebook.com/wakeupict" target="_blank" title="Facebook"><i
                                        class="fa fa-facebook-official text-white" style="font-size: 30px;"
                                        aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a href="https://www.linkedin.com/company/wakeupict/mycompany/" target="_blank"
                                    title="Linkedin"><i class="fa fa-linkedin-square text-white"
                                        style="font-size: 30px;" aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a href="https://twitter.com/wakeupict" target="_blank" title="Twitter"><i
                                        class="fa fa-twitter-square text-white" style="font-size: 30px;"
                                        aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="footer-copyright py-3" style="background-color: rgba(5, 22, 67, 0.9);">
        <div class="container">
            <div class="row">
                @php
                    $date = Carbon\Carbon::now();
                @endphp
                <div class="col-md-12 text-center">
                    <p class="text-white">Copyright Wake Up ICT © {{ Carbon\Carbon::parse($date)->format('Y') }}.
                        All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
