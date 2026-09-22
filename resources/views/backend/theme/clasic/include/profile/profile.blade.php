<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
    
        <li class="nav-item">
            <div class="dropdown ">
                <a href="" class="nav-link nav-link-profile  pt-0" data-toggle="dropdown">

                    @if (Auth::user()->photo == null)
                        <img style="height: 35px; width: 34px;" class="profile-user-img img-fluid img-circle"
                            src="{{ URL::asset('uploads/profile/demo.jpg') }}"
                            alt="{{ Auth::user()->name }}'s photo">
                        <span class="logged-name text-info"><span class="hidden-md-down"></span></span>
                    @else
                        <img style="height: 35px; width: 34px;" class="profile-user-img img-fluid img-circle"
                            src="{{ URL::asset(Auth::user()->photo) }}" alt="{{ Auth::user()->name }}'s photo">

                    @endif

                </a>
                <div class="dropdown-menu dropdown-menu-right bg-dark text-white">
                    <ul class="list-unstyled user-profile-nav list-group ">
                        <li class="list-group-item bg-dark">
                            <p class="p-0">{{ Auth::user()->name }}</p>
                            <small class="p-0">{{ Auth::user()->type }}</small>
                        </li>
                        <li class="list-group-item bg-dark"><a href="{{ route('profile') }}"><i
                                    class="far fa-user"></i>
                                Profile</a></li>
                        <li class="list-group-item bg-dark"><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                <i class="icon ion-power"></i> Sign Out</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div><!-- dropdown-menu -->
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
