<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

{{--    <title>{{ config('app.name', '') }}</title>--}}
    <title>:::Popularness:::</title>
{{--    <title>@yield('title')</title>--}}

{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">--}}
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">--}}
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>--}}
{{--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>--}}

    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
{{--    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>--}}

{{--    <!-- Fonts -->--}}
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9" charset="UTF-8"></script>

    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/slick-theme.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/jquery.smartmenus.bootstrap.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/slick.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/font-awesome.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/animate.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('jqueryUi/jquery-ui.min.css')}}" />

{{--    <script type="text/javascript" src="{{asset('js/jquery-1.11.1.min.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('jqueryUi/jquery-ui.min.js')}}"></script>
{{--    <script type="text/javascript" src="{{asset('front_assets/js/bootstrap.min.js')}}"></script>--}}
{{--    <script type="text/javascript" src="{{asset('front_assets/js/bootstrap.bundle.min.js')}}"></script>--}}

</head>
<body>

<script type="text/javascript" src="{{asset('js/elements/video-filters.js')}}"></script><style>
    .letters a.selected{
        background: #000;
        color: #FFF !important;
        padding: 6px;

    }
</style>
<script>
    jQuery(function () {
       VideosListing.url = '/getVideo';
        VideosListing.refresh();
        $("#filter-date").datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function (selectedDate)
            {
                VideosListing.url = '/getVideo/?date=' + selectedDate;
                VideosListing.refresh();
            }
        });

    });
</script>
<header class="wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="main-navigation">
                    <div class="d-flex justify-content-between">
                        <div class="humburger">
                            <a href="#" id="menu-toggle" class="toggle">
                                <img src="{{asset('front_assets/images/humburger-ico.png')}}">
                            </a>
                            <div id="sidebar-wrapper">
                                <ul class="sidebar-nav">
                                    <a id="menu-close" href="#" class="pull-right close toggle">&times;</a>
                                    <li class="sidebar-brand">
                                        <a href="{{url('/')}}">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{url('/')}}">About Us</a>
                                    </li>
                                    <li>
                                        <a href="{{url('page/company_profile')}}">Company Profile</a>
                                    </li>

                                    <li>
                                        <a href="{{url('page/contact')}}">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="nav-bar text-center">
                            <a class="navbar-brand" href="{{url('/')}}">
                                <img src="{{asset('front_assets/images/POPULARNESSWHITE.png')}}" class="img-fluid" alt="Popular Ness">
                            </a>
                        </div>
                        <div class="profile-sign text-right">
                            <ul>
                                @guest
                                <li><a href="#"><img src="{{asset('front_assets/images/sign1.png')}}"></a></li>
                                    <li><a href="{{url('upload')}}"><img src="{{asset('front_assets/images/sign2.png')}}"></a></li>
                                <li><a href="{{url('/login')}}"><img src="{{asset('front_assets/images/sign3.png')}}"></a></li>
                                @else
                                    <li><a href="{{url('upload')}}"><img src="{{asset('front_assets/images/sign2.png')}}"></a></li>
                                    <li class="nav-item dropdown">

                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span> <img src="{{env('AWS_S3_URL').env('APP_ENV')}}/user/{{Auth::user()->image}}" alt="AVATER" height="30px" width="30px">
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{url('/home')}}">
                                                My Account
                                            </a>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
{{--                                <li>--}}
{{--                                    <img src="{{asset('images/profile')}}/{{Auth::user()->image}}" alt="AVATER" height="30px" width="30px"><a href="{{url('/home')}}"> {{ Auth::user()->name}}</a>--}}

{{--                                </li>--}}
                                @endguest

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div id="app">
    <main class="py-4">
        @yield('content')
    </main>
</div>

<footer class="wow fadeInDown">
    <div class="container">
        <div class="row">
            <div class="col-2">
                <div class="foot-logo">
                    <img src="{{asset('front_assets/images/footer-logo.png')}}" class="img-fluid" alt="Loading">
                </div>
            </div>
            <div class="col-2">
                <div class="widget-item">
                    <h3>CORPORATE</h3>
                    <ul>
                        <li><a href="{{url('page/company_profile')}}">Company Profile</a></li>
                        <li><a href="{{url('page/advertising')}}">Advertising</a></li>
                        <li><a href="{{url('page/career')}}">Careers</a></li>
                        <li><a href="{{url('page/faq')}}">FAQ</a></li>
                        <li><a href="{{url('page/contact')}}">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-2">
                <div class="widget-item">
                    <h3>SERVICES</h3>
                    <ul>
                        <li><a href="{{url('page/packages')}}">Packages</a></li>
                        <li><a href="{{url('page/video_analysis')}}">Video Analytics</a></li>
                        <li><a href="{{url('page/royalties')}}">Royalties</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-2">
                <div class="widget-item">
                    <h3>MEDIA</h3>
                    <ul>
                        <li><a href="{{url('page/news')}}">In the News</a></li>
                        <li><a href="{{url('page/press_kit')}}">Press Kit</a></li>
                        <li><a href="{{url('page/media_inquiries')}}">Media Inquiries</a></li>
                        <li><a href="{{url('page/imagery')}}">Imagery</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-2">
                <div class="widget-item">
                    <h3>LEGAL / TOOLS</h3>
                    <ul>
                        <li><a href="{{url('page/terms')}}">Terms of Use</a></li>
                        <li><a href="{{url('page/policy')}}">Privacy Policy</a></li>
                        <li><a href="{{url('page/site_map')}}">Site Map</a></li>
                        <li><a href="{{url('page/partnership')}}">Our Partnership</a></li>
                        <li><a href="{{url('page/we_do')}}">What We Do</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-2">
                <div class="widget-item">
                    <h3>CONNECT</h3>
                    <ul>
                        <li><a class="facebook" href="http://www.facebook.com/popularness" target="_blank"><i class="fa fa-facebook"></i> Facebook</a></li>
                        <li><a class="twitter" href="http://www.twitter.com/popularness" target="_blank"><i class="fa fa-twitter"></i> Twitter</a></li>
                        <li><a class="googleplus" href="http://plus.google.com/" target="_blank"><i class="fa fa-google-plus"></i> Google+</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript" src="{{asset('front_assets/js/slick.js')}}"></script>
<script type="text/javascript" src="{{asset('front_assets/js/wow.min.js')}}"></script>
<script type="text/javascript" src="{{asset('front_assets/js/jquery.smartmenus.js')}}"></script>

<script  type="text/javascript" async>
    new WOW().init();

    $(document).ready(function () {
        $("#menu-close").click(function (e) {
            e.preventDefault();
            $("#sidebar-wrapper").toggleClass("active");
        });
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#sidebar-wrapper").toggleClass("active");
        });
    });

</script>

</body>
</html>