@extends('layouts.app')
@section('content')
    <div class="content-area">
        <div class="container">
            <style>
                .fanpage h3 {
                    font-weight: 300;
                }

                .fanpage, .login_section {
                    padding: 35px 0 40px;
                }

                .fanpage input, .login_section input {
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
            <div class="fanpage text-center">

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    {{--                    <div style="display:none;"><input type="hidden" name="_method" value="POST"></div><input type="hidden" name="data[User][duplicate]" id="duplicate">--}}

                    <div class="form-group">
                        <h3>BECOME A POPULARNESS MEMBER</h3>
                    </div>
                    <style>
                        .fanpage .nav.nav-tabs {
                            max-width: 400px;
                            margin: 35px auto;
                            font-size: 22px;
                        }

                        .fanpage .nav.nav-tabs .nav-item {
                            width: 50%;
                        }
                    </style>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <span class="nav-link active"
                                  style="border-top-right-radius: unset; border-color: #333 #333 #fff;">Fan</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               style="background-color: #2e56f2; border-color: #333 #333 #333 #2e56f2; color: #fff; border-top-left-radius: unset;"
                               href="{{url('/artistRegister')}}">Artist</a>
                        </li>
                    </ul>
                    <div class="form-group">
                        <div class="input text required">

                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                                       name="first_name" value="{{ old('first_name') }}"  required autocomplete="first_name" autofocus placeholder="First Name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror

                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input text required">

                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                                   name="last_name" value="{{ old('last_name') }}"  required autocomplete="last_name" autofocus placeholder="Last Name">
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input text required">

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input password">

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input password">


                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">

                        </div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="data[User][termsncon]" id="termsncon_" value="0"><input
                                type="checkbox" name="data[User][termsncon]" id="termsncon" value="public"> I accept the
                        <a id="terms" href="{{url('/terms')}}">Terms
                            &amp; Conditions</a>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-light signupartistfanbtn">Register</button>
                    </div>
                </form>
            </div>


            <div class="login_section text-center">
                <div class="login_section text-center">

                    <div class="form-group">
                        <h3>ALREADY A MEMBER?</h3>
                    </div>
                    <p>
                        <a href="{{url('/login')}}" class="btn btn-light">Login</a>
                    </p>

                </div>
            </div>

            <div class="Add" id="add" style="display: none;">


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
            <div class="clear"></div>
        </div>
    </div>
@endsection

