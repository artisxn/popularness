@extends('layouts.app')
@section('content')
    <div class="content-area">
        <div class="container">

            <link rel="stylesheet" type="text/css" href="../front_assets/css/user-type-content.css" />
            <style>
                .logn-area .btn i {
                    padding: 0px 12px;
                    font-size: 30px;
                }
            </style>
            <script>
                $(document).ready(function(){
                    $('.redirectButton').click(function(){
                        window.location = $(this).data('url');
                    });
                });
            </script>
            <div class="row user_type_content">
                <div class="col-sm-12 col-md-6 border-sign">

                    <div class="text-center signup-area">
                        <h5 class="title">BECOME A POPULARNESS MEMBER</h5>
                        <p class="offset-bottom">Join the POPULARNESS community to create your own playlists, rate and comment on stories, subscribe to your favorite categories and more.</p>
                        <fieldset>
                            <button data-url={{url('/fanRegister')}} type="button" class="btn btn-light redirectButton">Fan</button>
                            <span style="color: #848484; font-size:18px; margin:10px">OR</span>
                            <button data-url="{{url('/artistRegister')}}" type="button" class="btn btn-light redirectButton">Artist</button>
                        </fieldset>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 logn-area">
                    <div class="title text-center">
                        <h5>LOG IN</h5>
                    </div>

                    <div class="text-center" >
                        <div id="login_error" class="login_error custom_error" style="display:none;"></div>
                        <p>
                                <button type="button" class="btn">
                                    <a href="{{ url('login/facebook') }}"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                                    <a href="{{ url('login/twitter') }}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                    <a href="{{ url('login/google') }}"><i class="fa fa-google" aria-hidden="true"></i></a>
                                </button>
                        </p>
                        <p class="alt-form" data-ng-if="::$root.lang === 'en-us'">or</p>

                        <form method="POST" action="{{ route('login') }}">
                                                        @csrf

                            <div class="form-group">
                                <div class="input text required">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input password">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group" style="margin-left:-5px;">
                                <label class="switch">
                                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                                <label class="rember-me">Remember me</label>
                            </div>
                            <p>
                                <button type="submit" class="btn btn-light">
                                    {{ __('Login') }}
                                </button>

                            </p>


                            @if (Route::has('password.request'))
                                <a  href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </form>

                    </div>
                </div>
            </div>
            <div id="signup-wrapper">

                <div class="Add" id="add">
                </div>

                <script>
                    $(document).ready(function(){
                        if($("#add").html()){
                            var html=$("#add").html();

                            if(html.trim()==''){
                                $("#add").hide();
                            }

                        }else{

                            $("#add").show();
                        }

                    })

                </script>    <div class="clear"></div>
            </div>            </div>
    </div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
