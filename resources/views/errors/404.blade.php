<!DOCTYPE html>
<html lang="en">

<head>
    <!-- fab icon -->
    <link rel="shortcut icon" type="image/jpg" href="{{ URL::asset('frontend/image/wakeupict-fabicon.png') }}" />

    <link rel="stylesheet" href="{{ URL::asset('frontend/css/bootstrap.css') }}">
    <title>
        Error 404| Page not found
    </title>
    <style>
        /* CSS */
        .header404 {
            font-size: 1000%;
        }

        .button-17 {
            align-items: center;
            appearance: none;
            background-color: #fff;
            border-radius: 24px;
            border-style: none;
            box-shadow: rgba(0, 0, 0, .2) 0 3px 5px -1px, rgba(0, 0, 0, .14) 0 6px 10px 0, rgba(0, 0, 0, .12) 0 1px 18px 0;
            box-sizing: border-box;
            color: #3c4043;
            cursor: pointer;
            display: inline-flex;
            fill: currentcolor;
            font-family: "Google Sans", Roboto, Arial, sans-serif;
            font-size: 14px;
            font-weight: 500;
            height: 48px;
            justify-content: center;
            letter-spacing: .25px;
            line-height: normal;
            max-width: 100%;
            overflow: visible;
            padding: 2px 24px;
            position: relative;
            text-align: center;
            text-transform: none;
            transition: box-shadow 280ms cubic-bezier(.4, 0, .2, 1), opacity 15ms linear 30ms, transform 270ms cubic-bezier(0, 0, .2,
                    1) 0ms;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            width: auto;
            will-change: transform, opacity;
            z-index: 0;
            text-decoration: none;
        }

        .button-17:hover {
            background: #F6F9FE;
            color: #174ea6;
        }

        .button-17:active {
            box-shadow: 0 4px 4px 0 rgb(60 64 67 / 30%), 0 8px 12px 6px rgb(60 64 67 / 15%);
            outline: none;
        }

        .button-17:focus {
            outline: none;
            border: 2px solid #4285f4;
        }

        .button-17:not(:disabled) {
            box-shadow: rgba(60, 64, 67, .3) 0 1px 3px 0, rgba(60, 64, 67, .15) 0 4px 8px 3px;
        }

        .button-17:not(:disabled):hover {
            box-shadow: rgba(60, 64, 67, .3) 0 2px 3px 0, rgba(60, 64, 67, .15) 0 6px 10px 4px;
        }

        .button-17:not(:disabled):focus {
            box-shadow: rgba(60, 64, 67, .3) 0 1px 3px 0, rgba(60, 64, 67, .15) 0 4px 8px 3px;
        }

        .button-17:not(:disabled):active {
            box-shadow: rgba(60, 64, 67, .3) 0 4px 4px 0, rgba(60, 64, 67, .15) 0 8px 12px 6px;
        }

        .button-17:disabled {
            box-shadow: rgba(60, 64, 67, .3) 0 1px 3px 0, rgba(60, 64, 67, .15) 0 4px 8px 3px;
        }

    </style>
</head>

<body>
    <div class="container">
        <div class="row text-center">
            <div class="col-lg-8 offset-lg-2 col-sm-6 offset-sm-3 col-12 p-3 error-main">
                <div class="row">
                    <div class="col-lg-8 col-12 col-sm-10 offset-lg-2 offset-sm-1 justify-content-center"
                        style="margin-top: 35%">
                        <h1 class="header404" class="m-0">404</h1>
                        <h3>Page not found</h3>
                        <h5>Please visit the following pages </h5>
                    </div>
                    <div class="col-lg-12 col-12 col-sm-10  justify-content-center">
                        <div class="row">
                            <div class="col-md-2 my-2">
                                <a href="{{ route('home-page') }}" class="button-17" role="button">Home</a>
                            </div>
                            <div class="col-md-2 my-2">
                                <a href="{{ route('about-page') }}" class="button-17" role="button">About Us</a>
                            </div>
                            <div class="col-md-2 my-2">
                                <a href="{{ route('academic-training') }}" class="button-17"
                                    role="button">Traning</a>
                            </div>
                            <div class="col-md-2 my-2">
                                <a href="{{ route('services-page') }}" class="button-17"
                                    role="button">Services</a>
                            </div>
                            <div class="col-md-2 my-2">
                                <a href="{{ route('our-blogs') }}" class="button-17" role="button">Blogs</a>
                            </div>
                            <div class="col-md-2 my-2">
                                <a href="{{ route('contact-us-page') }}" class="button-17"
                                    role="button">Contact</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<!-- for use offline we use this code -->
<script type="text/javascript" src="{{ URL::asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('frontend/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('frontend/js/bootstrap.min.js') }}"></script>

</html>
