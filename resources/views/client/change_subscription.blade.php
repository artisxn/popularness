@extends('layouts.app')
@section('content')
<div class="content-area">
    <div class="container">
        <style>
            .fanpage h3 {
                font-weight: 300;
            }

            .login_section {
                padding: 35px 0 40px;
            }

            .fanpage {
                padding-bottom: 40px;
            }

            .fanpage select, .fanpage input, .login_section input {
                margin: 20px auto;
                border: 1px solid;
                max-width: 400px;

            }

            .fanpage .btn, .login_section .btn {
                width: 120px;
                border: 1px solid;
            }

            #flashMessage {
                color: #d60000;
            }

            .fanpage {
                border-bottom: 1px solid;
            }
        </style>

        <div class="row">
            <div class="col-4"></div>
            <div class="col-4"><h3>Your Current Package</h3></div>
            <div class="col-4"></div>

        </div>


        <div class="row">
            <div class="col-4">&nbsp;</div>
            <div class="col-4"> @if($package->price < 1)
                    <div class="price_table_inner">
                        <div class="first_box">
                            <h3 class="top_heading">INDY</h3>
                            <h1 class="bold_text">FREE</h1>
                            <p>for life</p>
                            <p class="section_contant">For aspiring recording artist looking to showcase their music
                                video</p>
                        </div>
                        <ul class="section_ul">
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">Artist/Band
                                Profile
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">1 Upload
                                per month
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">1 GB Total
                                Stroage
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">Music
                                Video Charting
                            </li>
                            <li class="section_li line_through_li">Global Video Analytics</li>
                            <li class="section_li line_through_li">Performance Report</li>
                            <li class="section_li line_through_li">Monetize your Videos</li>
                        </ul>
                    </div>
                @else
                    <div class="price_table_inner" data-uk-scrollspy="{cls:'uk-animation-slide-bottom', delay:300}">
                        <div class="second_box">
                            <h3 class="top_heading_paid">PRO</h3>
                            <h1 class="bold_text"><span class="dollar_sign">$</span>100<span
                                        class="dollar">USD</span></h1>
                            <p>per month</p>
                            <p class="section_contant">For professional recording artist looking to tour and make
                                money with their music videos</p>
                        </div>
                        <ul class="section_ul">
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">Artist/Band
                                Profile
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">3 Upload
                                per month
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">Unlimited
                                Stroage
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">Music
                                Video Charting
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">Global
                                Video Analytics
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">Performance
                                Report
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">Monetize
                                your Videos
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">Pledged
                                Support:Receive<br>100% of total pledged<br>contribution every quarter.
                            </li>
                        </ul>
                    </div>
                @endif</div>
            <div class="col-4"></div>


        </div>
        <div class="row">&nbsp;</div>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="col-sm-12">
                    <div class="price_table_inner">
                        <div class="first_box">
                            <h3 class="top_heading">INDY</h3>
                            <h1 class="bold_text">FREE</h1>
                            <p>for life</p>
                            <p class="section_contant">For aspiring recording artist looking to showcase their music
                                video</p>
                        </div>
                        <ul class="section_ul">
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">Artist/Band
                                Profile
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">1 Upload
                                per month
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">1 GB Total
                                Stroage
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">Music
                                Video Charting
                            </li>
                            <li class="section_li line_through_li">Global Video Analytics</li>
                            <li class="section_li line_through_li">Performance Report</li>
                            <li class="section_li line_through_li">Monetize your Videos</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="col-sm-12">
                    <div class="price_table_inner" data-uk-scrollspy="{cls:'uk-animation-slide-bottom', delay:300}">
                        <div class="second_box">
                            <h3 class="top_heading_paid">PRO</h3>
                            <h1 class="bold_text"><span class="dollar_sign">$</span>100<span
                                        class="dollar">USD</span></h1>
                            <p>per month</p>
                            <p class="section_contant">For professional recording artist looking to tour and make
                                money with their music videos</p>
                            @if($package->price < 1)
                            <a  href="{{route('change-package')}}" class="btn btn-primary box_button">Start Now</a>
                                @endif
                        </div>
                        <ul class="section_ul">
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">Artist/Band
                                Profile
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">3 Upload
                                per month
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">Unlimited
                                Stroage
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">Music
                                Video Charting
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">Global
                                Video Analytics
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">Performance
                                Report
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">Monetize
                                your Videos
                            </li>
                            <li class="section_li"><img class="check_check"
                                                        src="{{asset('images/Check-mark50.png')}}" alt="">Pledged
                                Support:Receive<br>100% of total pledged<br>contribution every quarter.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>



        <div class="Add" id="add">


        </div>

        <script>
            $(document).ready(function () {
                if ($("#add").html()) {
                    var html = $("#add").html();

                    if (html.trim() == '') {
                        $("#add").hide();
                    }

                } else {

                    $("#add").show();
                }

            })

        </script>
        <div style="clear:both"></div>
    </div>
    <style type="text/css">
        .price_table_main {
            text-align: center;
        }

        .row {
            margin-left: -15px;
            margin-right: -15px;
        }

        .top_heading {
            margin: 0 0 0 0;
            padding: 20px 0;
            background: #999;
            border: #e6e6e6;
            border-radius: 3px 3px 0px 0;
            font-weight: 600;
            font-size: 22px;
        }

        .section_ul {
            list-style-type: none;
            text-align: justify;
            display: table;
            margin: 0 auto 20px;
        }

        .bold_text {
            font-weight: 600;
            font-size: 50px;
            margin-bottom: 0px;
            margin-top: 10px;
        }

        .section_contant {
            color: #656565;
            font-size: 18px;
            padding: 0px 5px 10px;
        }

        .box_button {
            background-color: #0071e0;
            border: medium none #0071e0;
            color: #fff;
            font-size: 30px;
            margin: 0 0 30px;
            padding: 6px 30px;
        }

        .gray_button {
            background: #e6e6e6;
            border: #e6e6e6;
            color: #656565;
        }

        .section_li {
            padding: 5px 0px;
        }

        .fa-check {
            font-size: 20px;
            padding-right: 30px;
            color: green;
        }

        .section_li {
            font-size: 15px;
            padding-left: 38px;
            position: relative;
        }

        .check_check {
            position: absolute;
            top: 10px;
            left: 3px;
        }

        .dollar_sign {
            font-size: 45px;
        }

        .dollar {
            font-size: 20px;
            color: #0071e0;
        }

        .top_heading_paid {
            margin: 0 0 0 0;
            padding: 20px 0;
            background: #0071e0;
            color: #fff;
            border: #0071e0;
            border-radius: 3px 3px 0px 0;
            font-weight: 600;
            font-size: 22px;;
        }

        .line_through_li {
            text-decoration: line-through;
        }

        .price_table_inner {
            border: 2px solid #a5a5a5;
            border-radius: 5px;
            max-width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }

    </style>
</div>
@endsection

