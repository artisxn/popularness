@extends('layouts.app')
@section('content')
    <div class="home_slider Hero-Banner">
        <div class="container">
            <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <!--<ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1" class=""></li>
                </ol>-->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{asset('front_assets/images/banner1.jpg')}}" alt="">
                        <div class="carousel-caption ">
                            <div class="hero-text wow fadeInDown">
                                <h5>Avril Lavigne</h5>
                                <h3>Here's To Never Growing Up</h3>
                                <a href="#" class="defult-btn">Watch Video</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('front_assets/images/slide-2.jpg')}}" alt="">
                        <div class="carousel-caption ">
                            <div class="hero-text wow fadeInDown">
                                <h5>Aphex Twin</h5>
                                <h3>Avril 14th</h3>
                                <a href="#" class="defult-btn">Watch Video</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('front_assets/images/slide-3.jpg')}}" alt="">
                        <div class="carousel-caption ">
                            <div class="hero-text wow fadeInDown">
                                <h5>Boards of Canada</h5>
                                <h3>Reach For The Dead</h3>
                                <a href="#" class="defult-btn">Watch Video</a>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="{{asset('front_assets/images/slide-4.jpg')}}" alt="">
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
        <div class="container">
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
                                                @foreach($genres as $genre)
                                                    <li><label class="customcheck"><input type="checkbox" name="opt" value="{{$genre->id}}" data-id="{{$genre->id}}" class="chkboxlist"><span class="checkmark"></span></label><a  data-id="{{$genre->id}}"> {{$genre->genre}}</a></li>
                                                @endforeach
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
@endsection
