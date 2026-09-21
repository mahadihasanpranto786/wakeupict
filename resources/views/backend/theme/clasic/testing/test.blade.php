@extends('frontend.theme.clasic.frontend_layouts.master_layout')

@section('maincontent')
    <style>
        .blog__details__body .top__solid__mark_col4 {

            margin-bottom: 40px;
            background-color: rgba(41, 48, 94, 29);
            height: 10px;
            width: 100px;
        }

    </style>

    {{-- blog details --}}
    <section id="blog__details" class="pt-5">
        <div></div>
        <div class="blog__details_header-second text-white">
            <div class="container">
                <div class="text-center">
                    <h1>Somethings </h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima nihil possimus nobis dolores odio
                        temporibus asperiores sapiente laboriosam expedita eaque ducimus enim magni, eius voluptate,
                        assumenda, consequuntur sed laborum blanditiis id debitis tempora! Dolorum, dicta sit! Amet fugit
                        non voluptates ad, nulla vero exercitationem dolores tempore expedita, facilis culpa iure neque hic
                        atque id eligendi, molestiae corrupti placeat dicta nobis. Voluptate nam aperiam dolore esse soluta
                        adipisci vitae dignissimos maxime architecto laboriosam dolorem enim velit, asperiores quod veniam

                    </p>
                </div>
            </div>
        </div>
        <div class="blog__details_header-second-img text-center">
            <img src="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}" alt="dsfdsfsd">
        </div>
        <!-- Blog Details  -->
        {{-- first design --}}
        <div class="blog__details__body">
            <div class="container">
                <div class="text-center my-5">
                    <h1>Somethings</h1>
                </div>
                <div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="top__solid__mark_col4"></div>
                                <h4>Title</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis sunt expedita
                                    delectus quos eum corrupti quod impedit! Temporibus dicta minus, numquam recusandae
                                    debitis facilis consequuntur aspernatur nihil exercitationem sit amet, maxime sint,
                                    laudantium hic natus magni omnis sed nam? Accusamus quasi inventore quisquam voluptatem
                                </p>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}"><img
                                        src="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}"
                                        class="img-fluid" alt="dsfsdf"></a>
                            </div>
                            <div class="col-md-4">
                                <div class="top__solid__mark_col4"></div>
                                <h4>Title</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis sunt expedita
                                    delectus quos eum corrupti quod impedit! Temporibus dicta minus, numquam recusandae
                                    debitis facilis consequuntur aspernatur nihil exercitationem sit amet, maxime sint,
                                    laudantium hic natus magni omnis sed nam? Accusamus quasi inventore quisquam voluptatem
                                </p>
                            </div>
                        </div>

                    </div>


                    <div class="mb-3">
                        <div class="row">
                            <div>
                                <div class="top__solid__mark"></div>
                                <h4>Title</h4>
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis sunt expedita
                                    delectus quos eum corrupti quod impedit! Temporibus dicta minus, numquam recusandae
                                    debitis facilis consequuntur aspernatur nihil exercitationem sit amet, maxime sint,
                                    laudantium hic natus magni omnis sed nam? Accusamus quasi inventore quisquam voluptatem
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="blog__details__body--social">
                    <hr class="mt-5" style="border-top: 3px solid gray">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-2">
                            <div class="m-1 p-3 text-center" style="background-color: #3b5998;"><a
                                    href="https://www.facebook.com/wakeupict" target="blank" class="text-white"><i
                                        class="fa fa-facebook-official" aria-hidden="true"></i>
                                    Facebook</a> </div>
                        </div>
                        <div class="col-md-2">
                            <div class="m-1 p-3 text-center" style="background-color: #0077b5;"><a target="blank"
                                    href="https://www.linkedin.com/company/wakeupict/mycompany/" class="text-white"><i
                                        class="fa fa-linkedin-square" aria-hidden="true"></i>
                                    LinkedIn</a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="m-1 p-3 text-center" style="background-color: #1da1f2;"><a target="blank"
                                    href="https://twitter.com/wakeupict" class="text-white"><i
                                        class="fa fa-twitter-square" aria-hidden="true"></i>
                                    Twitter</a>
                            </div>
                        </div>
                        {{-- <div class="col-md-2">
                            <div class="m-1 p-3 text-center" style="background-color: #bd081c;"><a href="#"
                                    class="text-white"><i class="fa fa-pinterest-square" aria-hidden="true"></i>
                                    Pinterest</a> </div>
                        </div>
                        <div class="col-md-2">
                            <div class="m-1 p-3 text-center" style="background-color: #dd4b39;"><a target="blank"
                                    href="mailto:info@wakeupict.com" title="glorythemes" class="text-white"><i
                                        class="fa fa-envelope" aria-hidden="true"></i> Email</a>
                            </div>
                        </div> --}}
                    </div>
                </div>

            </div>
        </div>

    </section>
    {{-- carousel --}}

    {{-- second design --}}
    <style>
        .custom-scrollbar-js,
        .custom-scrollbar-css {
            height: 200px;
        }


        /* Custom Scrollbar using CSS */
        .custom-scrollbar-css {
            overflow-y: scroll;
        }

        /* scrollbar width */
        .custom-scrollbar-css::-webkit-scrollbar {
            width: 5px;
        }

        /* scrollbar track */
        .custom-scrollbar-css::-webkit-scrollbar-track {
            background: #eee;
        }

        /* scrollbar handle */
        .custom-scrollbar-css::-webkit-scrollbar-thumb {
            border-radius: 1rem;
            background-color: #00d2ff;
            background-image: linear-gradient(to top, #00d2ff 0%, #3a7bd5 100%);
        }

        .col {
            border-radius: 10px;
        }

    </style>
    @php
    $blocks = App\model\Blog::select(['blog_image', 'id'])
        // ->take(8)
        ->get();
    @endphp
    <div class="container py-5 blog__details__body">
        <div class="text-center my-5">
            <h1>A title here</h1>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4 p-2">
                    <div class="card-body">
                        <h4 class="mb-4">Image Gallary</h4>
                        <div class="custom-scrollbar-css">
                            <div class="row m-2 pop_up">
                                @foreach ($blocks as $item)
                                    <div class="col-md-6">
                                        <a href="{{ URL::asset($item->blog_image) }}"><img class='col'
                                                style=" border: 2px solid gray; margin: 5px"
                                                src="{{ URL::asset($item->blog_image) }}" alt=""></a>
                                    </div>
                                @endforeach

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="top__solid__mark_col4"></div>
                <h4>Title</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis sunt expedita
                    delectus quos eum corrupti quod impedit! Temporibus dicta minus, numquam recusandae
                    debitis facilis consequuntur aspernatur nihil exercitationem sit amet, maxime sint,
                    laudantium hic natus magni omnis sed nam? Accusamus quasi inventore quisquam voluptatem
                </p>
            </div>

        </div>
    </div>


    <div class="blog__details__body">
        <div class="container">
            <div class="text-center my-5">
                <h1>Somethings</h1>
            </div>
            <div>
                <div class="mb-3">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}" class="img-fluid"
                            alt="dsfsdf">
                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <div class="top__solid__mark_col4"></div>
                    <h4>Title</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis sunt expedita
                        delectus quos eum corrupti quod impedit! Temporibus dicta minus, numquam recusandae
                        debitis facilis consequuntur aspernatur nihil exercitationem sit amet, maxime sint,
                        laudantium hic natus magni omnis sed nam? Accusamus quasi inventore quisquam voluptatem
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- third design --}}
    <div class="blog__details__body">
        <div class="container">
            <div class="text-center my-5">
                <h1>Somethings</h1>
            </div>
            <div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">

                            <a href="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}"> <img
                                    style="border: 1px solid #181717;"
                                    src="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}"
                                    class="img-fluid id" alt="dsfsdf"
                                    data-zoom-image="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}"></a>

                        </div>
                        <div class="col-md-4 col-sm-4">
                            <a href="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}">
                                <img src="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}"
                                    class="img-fluid id" alt="dsfsdf"
                                    data-zoom-image="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}"></a>
                        </div>
                        <div class="col-md-4 col-sm-4">

                            <a href="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}">
                                <img src="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}"
                                    class="img-fluid id" alt="dsfsdf"
                                    data-zoom-image="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <div class="top__solid__mark_col4"></div>
                    <h4>Title</h4>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis sunt expedita
                        delectus quos eum corrupti quod impedit! Temporibus dicta minus, numquam recusandae
                        debitis facilis consequuntur aspernatur nihil exercitationem sit amet, maxime sint,
                        laudantium hic natus magni omnis sed nam? Accusamus quasi inventore quisquam voluptatem
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- forth design --}}

    <div class="blog__details__body">
        <div class="container">
            <div class="text-center my-5">
                <h1>forth design</h1>
            </div>
            <div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="top__solid__mark_col4"></div>
                            <h4>Title</h4>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis sunt expedita
                                delectus quos eum corrupti quod impedit! Temporibus dicta minus, numquam recusandae
                                debitis facilis consequuntur aspernatur nihil exercitationem sit amet, maxime sint,
                                laudantium hic natus magni omnis sed nam? Accusamus quasi inventore quisquam voluptatem
                            </p>
                        </div>
                        <div class="col-md-4 justify-content-center">
                            <div class="col-sm-6 col-md-6 ml-auto mt-3">
                                <img src="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}"
                                    class="img-fluid id" alt="dsfsdf"
                                    data-zoom-image="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}">
                            </div>
                            <div class="col-md-6 mt-3  ml-auto">
                                <img src="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}"
                                    class="img-fluid id" alt="dsfsdf"
                                    data-zoom-image="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 ml-auto">
                            <img src="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}"
                                class="img-fluid id" alt="dsfsdf"
                                data-zoom-image="{{ asset('public/uploads/blog/images/1709785732805480.jpg') }}">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- sixth design --}}
    <style>
        .row {
            display: flex;
            flex-wrap: wrap;
            padding: 0 4px;
        }

        /* Create four equal columns that sits next to each other */
        .column {
            flex: 25%;
            max-width: 33.3%;
            padding: 0 4px;
        }

        .column img {
            margin-top: 8px;
            vertical-align: middle;
            width: 100%;
            filter: grayscale(1) brightness(0.5);
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s linear;
        }

        .column img:hover {
            filter: grayscale(0);
        }

        @media screen and (max-width: 800px) {
            .column {
                flex: 50%;
                max-width: 50%;
            }
        }

        /* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
            .column {
                flex: 100%;
                max-width: 100%;
            }

            .column img {
                filter: grayscale(0) brightness(1);
            }
        }

    </style>
    <div class="blog__details__body">
        <div class="container">
            <div class="text-center my-5">
                <h1>Sixth design</h1>
            </div>

            <div class="col-md-12">
                <div class="top__solid__mark_col4"></div>
                <h4>Title</h4>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis sunt expedita
                    delectus quos eum corrupti quod impedit! Temporibus dicta minus, numquam recusandae
                    debitis facilis consequuntur aspernatur nihil exercitationem sit amet, maxime sint,
                    laudantium hic natus magni omnis sed nam? Accusamus quasi inventore quisquam voluptatem
                </p>
            </div>
            <div class="mb-3">
                <div class="row">
                    @foreach ($blocks as $block)
                        <div class="column">
                            <a href="{{ asset($block->blog_image) }}"><img class="id"
                                    src='{{ asset($block->blog_image) }}'
                                    data-zoom-image="{{ asset($block->blog_image) }}" alt="hi" /></a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
        integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <div class="blog__details__body">
        <div class="container">
            <div class="text-center my-5">
                <h1>Sixth design</h1>
            </div>

            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="fotorama">
                            @foreach ($blocks as $block)
                                <a href="#"><img class="id" src='{{ asset($block->blog_image) }}'
                                        alt="hi" /></a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="top__solid__mark"></div>
                        <h4>Title</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis sunt expedita
                            delectus quos eum corrupti quod impedit! Temporibus dicta minus, numquam recusandae
                            debitis facilis consequuntur aspernatur nihil exercitationem sit amet, maxime sint,
                            laudantium hic natus magni omnis sed nam? Accusamus quasi inventore quisquam voluptatem
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    @foreach ($blocks as $item)
        <div class="modal fade" id="blog{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img class="card-img-top" src="{{ URL::asset($item->blog_image) }}" alt="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script type="text/javascript" src="{{ URL::asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"
        integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.column,.col-md-4, .pop_up').magnificPopup({
            delegate: 'a',
            type: 'image'
        });
    </script>
    <!-- Fotorama from CDNJS, 19 KB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/zoom.js') }}"></script>
    <script>
        $('.id').elevateZoom({
            zoomType: "inner",
            cursor: "crosshair"
        });
    </script>

@endsection
