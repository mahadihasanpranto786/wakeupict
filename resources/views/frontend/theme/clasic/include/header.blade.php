<div class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgb(248,248,248);">
        <div class="container">
            <a href="{{ route('home-page') }}" class="navbar-brand">
                <img src="{{ URL::asset('frontend/image/wict-logo.png') }}" width="140" height="45" alt="Wake Up ICT">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href=" {{ route('home-page') }}" class="nav-link text-dark">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('about-page') }}" class="nav-link text-dark">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('academic-training') }}" class="nav-link text-dark">Academic Training</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('services-page') }}" class="nav-link text-dark">Services</a>
                    </li>
                    <!-- <li class="nav-item">
                          <a href="apply_for_job.html#apply" class="nav-link text-dark">Career</a>
                      </li> -->
                    <!-- <li class="nav-item">
                          <a href="contact.html#contact" class="nav-link text-dark">Contact</a>
                      </li> -->
                    <li class="nav-item">
                        <a href="{{ route('our-blogs') }}" class="nav-link text-dark">Our Blogs</a>
                    </li>

             
                    @php
                        $post = App\model\TalentHunt::orderBy('id', 'asc')->first();
                    @endphp

                    @if (isset($post) && $post->status == 1)
                        <li class="nav-item">
                            <a href="{{ route('talent-hunt') }}" class="nav-link text-dark">Talent Hunt</a>
                        </li>
                    @endif

                    <li class="nav-item bg-warning">
                        <a href="{{ route('contact-us-page') }}" class="nav-link text-white">Get A Quote</a>
                    </li>
                    <!-- <li class="nav-item bg-warning">
              <a href="/covid.php" class="nav-link text-white">Available Hospital Info</a>
            </li> -->
                </ul>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light bg-warning">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav ml-auto">
                    <!-- <li class="nav-item">
                          <a href="services.html#web-graphic" class="nav-link">Web & Graphic Design</a>
                      </li>
                      <li class="nav-item">
                          <a href="services.html#payroll-services" class="nav-link">Payroll Services</a>
                      </li>
                      <li class="nav-item">
                          <a href="services.html#account-finance" class="nav-link">Accounting & Finance</a>
                      </li>
                      <li class="nav-item">
                          <a href="services.html#hrm-services" class="nav-link">HRM Services</a>
                      </li>
                      <li class="nav-item">
                          <a href="services.html#digital-marketing" class="nav-link">Digital Marketing </a>
                      </li>
                      <li class="nav-item">
                          <a href="services.html#software-development" class="nav-link">Software Development</a>
                      </li> -->
                </ul>
            </div>
        </div>
    </nav>
</div>
