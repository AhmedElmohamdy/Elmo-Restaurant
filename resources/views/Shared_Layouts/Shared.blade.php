<!DOCTYPE html>
<html>

<head>
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="">

    <title> @yield('Title') </title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}" />

    <!--owl slider stylesheet -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <!-- nice select  -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css"
        integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ=="
        crossorigin="anonymous" />
    <!-- font awesome style -->
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <!-- responsive style -->
    <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" />

</head>

<body>

    <div class="hero_area">
        <div class="bg-box">
            <img src="{{ asset('assets/images/hero-bg.jpg') }}" alt="">
        </div>
        <!-- header section strats -->
        <header class="header_section">
            <div class="container">
                <nav class="navbar navbar-expand-lg custom_nav-container ">
                    <a class="navbar-brand" href="{{ route('home.index') }}">
                        @if (!empty($setting->logo))
                            <img src="{{ asset($setting->logo) }}" alt="{{ $setting->site_name }}"
                                style="height:100px;">
                        @else
                            <span>{{ $setting->site_name }}</span>
                        @endif
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class=""> </span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav  mx-auto ">
                            <li class="nav-item active">
                                <a class="nav-link" href="{{ route('home.index') }}">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('Category.GetAllCategories') }}">Categries</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('Product.GetMenu') }}">Menu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home.about') }}">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('reviews.index') }}">Reviews</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home.booking') }}">Book Table</a>
                            </li>
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item"> {{-- If li in main-menu take class give same to li in login,register,logout --}}
                                        <a class="nav-link active" href="{{ route('login') }}">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{ route('register') }}">Register</a>
                                    </li>
                                @endif

                                {{-- @if (Route::has('register'))
                                    <li >
                                        <a  href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif --}}
                            @else
                                <li class="nav-item">
                                    <a class="nav-link active">
                                        Hello... {{ Auth::user()->name }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>

                            @endguest
                        </ul>
                        <div class="user_option">
                            <a href="" class="user_link">
                                <a href="{{ route('Category.GetAllCategories') }}" class="order_online">
                                    Get Items
                                </a>
                        </div>
                    </div>
                </nav>
            </div>
        </header>
        <!-- end header section -->
        <!-- slider section -->
        <section class="slider_section">
            <div id="customCarousel1" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">

                    @foreach ($sliders as $index => $slider)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-7 col-lg-6">
                                        <div class="detail-box">
                                            <h1>
                                                {{ $slider->title }}
                                            </h1>
                                            <p>
                                                {{ $slider->description }}
                                            </p>
                                            <div class="btn-box">
                                                <a href="" class="btn1">
                                                    Get Items
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-lg-6">
                                        <div class="img-box">
                                            <img src="{{ asset($slider->image) }}" alt="{{ $slider->title }}"
                                                class="img-fluid slider-image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                {{-- Carousel indicators --}}
                <div class="container">
                    <ol class="carousel-indicators">
                        @foreach ($sliders as $index => $slider)
                            <li data-target="#customCarousel1" data-slide-to="{{ $index }}"
                                class="{{ $index == 0 ? 'active' : '' }}"></li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </section>
        <!-- end slider section -->
    </div>





    @yield('Content')













    <!-- footer section -->
    <footer class="footer_section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 footer-col">
                    <div class="footer_contact">
                        <h4>Contact Us</h4>
                        <div class="contact_link_box">

                            <a href="">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>{{ $setting->address }}</span>
                            </a>



                            <a href="tel:{{ $setting->phone }}">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>Call : {{ $setting->phone }}</span>
                            </a>



                            <a href="mailto:{{ $setting->email }}">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>{{ $setting->email }}</span>
                            </a>

                        </div>
                    </div>
                </div>

                <div class="col-md-4 footer-col">
                    <div class="footer_detail">
                        {{-- Site Name --}}
                        <a href="{{ route('home.index') }}" class="footer-logo">
                            {{ $setting->site_name ?? 'Feane' }}
                        </a>

                        {{-- Site Description --}}
                        <p>
                            {{ $setting->about_us ?? 'Welcome to our restaurant website.' }}
                        </p>

                        {{-- Social Links --}}
                        <div class="footer_social">
                            @if ($setting->facebook)
                                <a href="{{ $setting->facebook }}" target="_blank">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                </a>
                            @endif

                            @if ($setting->twitter)
                                <a href="{{ $setting->twitter }}" target="_blank">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                </a>
                            @endif

                            @if ($setting->linkedin)
                                <a href="{{ $setting->linkedin }}" target="_blank">
                                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                                </a>
                            @endif

                            @if ($setting->instagram)
                                <a href="{{ $setting->instagram }}" target="_blank">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                </a>
                            @endif

                            @if ($setting->pinterest)
                                <a href="{{ $setting->pinterest }}" target="_blank">
                                    <i class="fa fa-pinterest" aria-hidden="true"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4 footer-col">
                    <h4>
                        Opening Hours
                    </h4>
                    <p>
                        {{ $setting->opening_days  }}
                    </p>
                    <p>
                        {{ $setting->opening_hours  }}
                    </p>
                </div>

            </div>
            <div class="footer-info">
                <p>
                    &copy; <span id="displayYear"></span> All Rights Reserved By
                    <a href="https://html.design/">elmohamdy2002@gmail.com</a><br><br>
                 
                </p>
            </div>
        </div>
    </footer>
    <!-- footer section -->

    <!-- jQery -->
    <script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- bootstrap js -->
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <!-- owl slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
    <!-- nice select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
    <!-- custom js -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
    </script>
    <!-- End Google Map -->



    <!--Important-->
    <!-- jQuery (if not already included) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Slick JS -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


    <!--For Filter-->
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>
    <script>
        var $grid = $('.grid').isotope({
            itemSelector: '.col-sm-6',
            layoutMode: 'fitRows'
        });

        $('.filters_menu li').on('click', function() {
            $('.filters_menu li').removeClass('active');
            $(this).addClass('active');

            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });
    </script>


</body>

</html>
