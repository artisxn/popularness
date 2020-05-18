<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>::: Popular Ness :::</title>



    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/slick-theme.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/style.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/jquery.smartmenus.bootstrap.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/slick.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/font-awesome.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/animate.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('front_assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('jqueryUi/jquery-ui.min.css')}}" />


    <script type="text/javascript" src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('jqueryUi/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('front_assets/js/bootstrap.bundle.min.js')}}"></script>

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

        VideosListing.url = 'videos/get_videos_html/index.html';
        VideosListing.refresh();
        $("#filter-date").datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function (selectedDate)
            {
                VideosListing.url = 'http://54.147.158.240/videos/get_videos_html/?date=' + selectedDate;
                VideosListing.refresh();
            }
        });

    });
</script>
<header class="wow fadeInDown">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="main-navigation">
                    <div class="d-flex justify-content-between">
                        <div class="humburger">
                            <a href="#" id="menu-toggle" class="toggle">
                                <img src="front_assets/images/humburger-ico.png">
                            </a>
                            <div id="sidebar-wrapper">
                                <ul class="sidebar-nav">
                                    <a id="menu-close" href="#" class="pull-right close toggle">&times;</a>
                                    <li class="sidebar-brand">
                                        <a href="{{url('/')}}">Home</a>
                                    </li>
                                    <li>
                                        <a href="index/home.html">About Us</a>
                                    </li>
                                    <li>
                                        <a href="pages/company_profile.html">Company Profile</a>
                                    </li>

                                    <li>
                                        <a href="pages/contactus.html">Contact Us</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="nav-bar text-center">
                            <a class="navbar-brand" href="#">
                                <img src="front_assets/images/POPULARNESSWHITE.png" class="img-fluid" alt="Popular Ness">
                            </a>
                        </div>
                        <div class="profile-sign text-right">
                            <ul>
                                <li><a href="#"><img src="front_assets/images/sign1.png"></a></li>
                                <li><a href="users/user_type.html"><img src="front_assets/images/sign2.png"></a></li>
                                <li><a href="users/user_type.html"><img src="front_assets/images/sign3.png"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>



<div class="home_slider Hero-Banner">
    <div class="container-fluid">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <!--<ol class="carousel-indicators">
                    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleCaptions" data-slide-to="1" class=""></li>
            </ol>-->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="front_assets/images/banner1.jpg" alt="">
                    <div class="carousel-caption ">
                        <div class="hero-text wow fadeInDown">
                            <h5>Avril Lavigne</h5>
                            <h3>Here's To Never Growing Up</h3>
                            <a href="#" class="defult-btn">Watch Video</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="front_assets/images/slide-2.jpg" alt="">
                    <div class="carousel-caption ">
                        <div class="hero-text wow fadeInDown">
                            <h5>Aphex Twin</h5>
                            <h3>Avril 14th</h3>
                            <a href="#" class="defult-btn">Watch Video</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="front_assets/images/slide-3.jpg" alt="">
                    <div class="carousel-caption ">
                        <div class="hero-text wow fadeInDown">
                            <h5>Boards of Canada</h5>
                            <h3>Reach For The Dead</h3>
                            <a href="#" class="defult-btn">Watch Video</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="front_assets/images/slide-4.jpg" alt="">
                    <div class="carousel-caption ">
                        <div class="hero-text wow fadeInDown">
                            <h5>Aphex Twin</h5>
                            <h3>minipops 67 [120.2][source field mix]</h3>
                            <a href="#" class="defult-btn">Watch Video</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
<div class="content-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <div class="content-body-left wow fadeInLeft">
                    <h2>FILTER BY</h2>
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse"  href="#menuone" aria-expanded="true" aria-controls="menuone">Date 1<span class="collapsed"><p><b><i class="fa fa-angle-down" aria-hidden="true"></i></b></p></span>
                                    <span class="expanded"><p><b><i class="fa fa-angle-up" aria-hidden="true"></i></b></p></span></a>
                            </div>
                            <div id="menuone" class="collapse show">
                                <div class="card-body">
                                    <div id="filter-date"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse"  href="#menutwo" aria-expanded="true" aria-controls="menutwo">Genre<span class="collapsed"><p><b><i class="fa fa-angle-down" aria-hidden="true"></i></b></p></span>
                                    <span class="expanded"><p><b><i class="fa fa-angle-up" aria-hidden="true"></i></b></p></span></a>
                            </div>
                            <div id="menutwo" class="collapse show">
                                <div class="card-body">
                                    <div class="filter filter-videos">
                                        <ul>
                                            <li><label class="customcheck"><input type="checkbox" name="opt" value="5" data-id="5" class="chkboxlist"><span class="checkmark"></span></label><a  data-id="5"> Alternative/Rock</a></li><li><label class="customcheck"><input type="checkbox" name="opt" value="12" data-id="12" class="chkboxlist"><span class="checkmark"></span></label><a  data-id="12"> Classical</a></li><li><label class="customcheck"><input type="checkbox" name="opt" value="4" data-id="4" class="chkboxlist"><span class="checkmark"></span></label><a  data-id="4"> Country</a></li><li><label class="customcheck"><input type="checkbox" name="opt" value="10" data-id="10" class="chkboxlist"><span class="checkmark"></span></label><a  data-id="10"> Dance/Electronic</a></li><li><label class="customcheck"><input type="checkbox" name="opt" value="7" data-id="7" class="chkboxlist"><span class="checkmark"></span></label><a  data-id="7"> Gospel/Spiritual</a></li><li><label class="customcheck"><input type="checkbox" name="opt" value="2" data-id="2" class="chkboxlist"><span class="checkmark"></span></label><a  data-id="2"> Hip-Hop/Rap</a></li><li><label class="customcheck"><input type="checkbox" name="opt" value="9" data-id="9" class="chkboxlist"><span class="checkmark"></span></label><a  data-id="9"> International/World</a></li><li><label class="customcheck"><input type="checkbox" name="opt" value="11" data-id="11" class="chkboxlist"><span class="checkmark"></span></label><a  data-id="11"> Jazz/Blues</a></li><li><label class="customcheck"><input type="checkbox" name="opt" value="6" data-id="6" class="chkboxlist"><span class="checkmark"></span></label><a  data-id="6"> Latin</a></li><li><label class="customcheck"><input type="checkbox" name="opt" value="1" data-id="1" class="chkboxlist"><span class="checkmark"></span></label><a  data-id="1"> Pop</a></li><li><label class="customcheck"><input type="checkbox" name="opt" value="3" data-id="3" class="chkboxlist"><span class="checkmark"></span></label><a  data-id="3"> R&B/Soul</a></li><li><label class="customcheck"><input type="checkbox" name="opt" value="8" data-id="8" class="chkboxlist"><span class="checkmark"></span></label><a  data-id="8"> Reggae/Caribbean</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse"  href="#menuthree" aria-expanded="true" aria-controls="menuthree">Artist<span class="collapsed"><p><b><i class="fa fa-angle-down" aria-hidden="true"></i></b></p></span>
                                    <span class="expanded"><p><b><i class="fa fa-angle-up" aria-hidden="true"></i></b></p></span></a>
                            </div>
                            <div id="menuthree" class="collapse show">
                                <div class="card-body filter filter-artist">
                                    <ul class="letters">
                                        <li><a data-id="A" href="#">A</a></li><li><a data-id="B" href="#">B</a></li><li><a data-id="C" href="#">C</a></li><li><a data-id="D" href="#">D</a></li><li><a data-id="E" href="#">E</a></li><li><a data-id="F" href="#">F</a></li><li><a data-id="G" href="#">G</a></li><li><a data-id="H" href="#">H</a></li><li><a data-id="I" href="#">I</a></li><li><a data-id="J" href="#">J</a></li><li><a data-id="K" href="#">K</a></li><li><a data-id="L" href="#">L</a></li><li><a data-id="M" href="#">M</a></li><li><a data-id="N" href="#">N</a></li><li><a data-id="O" href="#">O</a></li><li><a data-id="P" href="#">P</a></li><li><a data-id="Q" href="#">Q</a></li><li><a data-id="R" href="#">R</a></li><li><a data-id="S" href="#">S</a></li><li><a data-id="T" href="#">T</a></li><li><a data-id="U" href="#">U</a></li><li><a data-id="V" href="#">V</a></li><li><a data-id="W" href="#">W</a></li><li><a data-id="X" href="#">X</a></li><li><a data-id="Y" href="#">Y</a></li><li><a data-id="Z" href="#">Z</a></li>                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="content-body-right">
                    <div id="primary">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="wow fadeInDown">
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <div class="foot-logo">
                    <img src="front_assets/images/footer-logo.png" class="img-fluid" alt="Loading">
                </div>
            </div>
            <div class="col-2">
                <div class="widget-item">
                    <h3>CORPORATE</h3>
                    <ul>
                        <li><a href="pages/company_profile.html">Company Profile</a></li>
                        <li><a href="pages/advertising.html">Advertising</a></li>
                        <li><a href="pages/careers.html">Careers</a></li>
                        <li><a href="faqs.html">FAQ</a></li>
                        <li><a href="pages/contactus.html">Contact Us</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-2">
                <div class="widget-item">
                    <h3>SERVICES</h3>
                    <ul>
                        <li><a href="packages.html">Packages</a></li>
                        <li><a href="pages/video_analytics.html">Video Analytics</a></li>
                        <li><a href="pages/royalties.html">Royalties</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-2">
                <div class="widget-item">
                    <h3>MEDIA</h3>
                    <ul>
                        <li><a href="inthe_news.html">In the News</a></li>
                        <li><a href="pages/press_kit.html">Press Kit</a></li>
                        <li><a href="pages/media_inquiries.html">Media Inquiries</a></li>
                        <li><a href="pages/imagery.html">Imagery</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-2">
                <div class="widget-item">
                    <h3>LEGAL / TOOLS</h3>
                    <ul>
                        <li><a href="{{url('/terms')}}">Terms of Use</a></li>
                        <li><a href="pages/privacypolicy.html">Privacy Policy</a></li>

                        <li><a href="static_pages/error.html">Site Map</a></li>
                        <li><a href="static_pages/error.html">Our Partnership</a></li>
                        <li><a href="static_pages/error.html">What We Do</a></li>
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
