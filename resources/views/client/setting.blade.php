@extends('layouts.client_app')

@section('client_content')
    <div id="clientSettingApp">
        <div class="row">
            <div class="col-5"></div>
            <div class="col-2"><p>MY SETTINGS</p></div>
            <div class="col-4"></div>
        </div>
        <nav>
            <div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                   role="tab" aria-controls="nav-profile" aria-selected="true">
                    Profile
                </a>
                {{--            <a class="nav-item nav-link" id="nav-notification-tab" data-toggle="tab"--}}
                {{--               href="#nav-notification" role="tab" aria-controls="nav-notification"--}}
                {{--               aria-selected="false">Notifications</a>--}}
                {{--            <a class="nav-item nav-link" id="nav-newsletter-tab" data-toggle="tab"--}}
                {{--               href="#nav-newsletter" role="tab" aria-controls="nav-newsletter" aria-selected="false">Newsletter</a>--}}
                {{--            <a class="nav-item nav-link" id="nav-connection-tab" data-toggle="tab"--}}
                {{--               href="#nav-connection" role="tab" aria-controls="nav-connection" aria-selected="false">Connections</a>--}}
                {{--            <a class="nav-item nav-link" id="nav-account-tab" data-toggle="tab" href="#nav-account"--}}
                {{--               role="tab" aria-controls="nav-account" aria-selected="false">Account</a>--}}
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
                 aria-labelledby="nav-profile-tab">
                <div class="row" style="border: 0px solid gray">
                    <div class="col-3">&nbsp;</div>
                    <div class="col-9" style="border:0px solid red;">
                        <div class="row">
                            <div class="col-8">
                                <form method="POST" action="{{ url('user/update') }}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <img src="{{$data->image}}" alt="AVATER"
                                         height="100px" width="100px">
                                    <hr>
                                    <input type="file" name="profile_image" class="form-control">
                                    @if ($data->user_type === 2)

                                        <div class="form-group">
                                            @error('name')
                                            <input id="name" type="text"
                                                   class="form-control @error('name') is-invalid @enderror"
                                                   name="name"
                                                   value="{{ old('name') }}" required autocomplete="name"
                                                   autofocus>
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                            @else
                                                <input id="name" type="text" class="form-control"
                                                       name="name"
                                                       value="{{$data->name}}" required autocomplete="name" placeholder="Artist / Brand Name"
                                                       autofocus>
                                                @enderror
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <div class="input text">

                                            @error('first_name')
                                            <input id="first_name" type="text"
                                                   class="form-control @error('first_name') is-invalid @enderror"
                                                   name="first_name"
                                                   value="{{ old('first_name') }}" required
                                                   autocomplete="first_name"
                                                   autofocus>
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                            @else
                                                <input id="first_name" type="text" class="form-control"
                                                       name="first_name"
                                                       value="{{$data->first_name}}" required
                                                       autocomplete="first_name" placeholder="First Name"
                                                       autofocus>
                                                @enderror

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input text">

                                            @error('last_name')
                                            <input id="last_name" type="text"
                                                   class="form-control @error('last_name') is-invalid @enderror"
                                                   name="last_name"
                                                   value="{{ old('last_name') }}" required
                                                   autocomplete="last_name"
                                                   autofocus>
                                            <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                            @else
                                                <input id="last_name" type="text" class="form-control"
                                                       name="last_name"
                                                       value="{{$data->last_name}}" required
                                                       autocomplete="last_name" placeholder="Last Name"
                                                       autofocus>
                                                @enderror

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input text required">

                                            <input id="email" type="email" class="form-control" readonly=""
                                                   name="email"
                                                   value="{{$data->email}}" required
                                                   autocomplete="email"
                                                   autofocus>


                                        </div>
                                    </div>
                                    <div class="form-group">
                                        @error('dob')
                                        <input id="dob" type="text"
                                               class="form-control @error('dob') is-invalid @enderror"
                                               name="dob"
                                               value="{{ old('dob') }}" required autocomplete="dob"
                                               autofocus>
                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                    </span>
                                        @else
                                            <input id="dob" type="date" class="form-control" name="dob"
                                                   value="{{$data->dob}}" required autocomplete="dob"
                                                   autofocus>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="input select">
                                            <select name="gender"
                                                    class="form-control" id="gender">
                                                <option value="">Select Your Gender</option>
                                                <option value="1" {{$data->gender == 1?'selected="selected"':''}}>
                                                    Male
                                                </option>
                                                <option value="2" {{$data->gender == 2?'selected="selected"':''}}>
                                                    Female
                                                </option>
                                                <option value="3" {{$data->gender == 3?'selected="selected"':''}}>
                                                    Unset
                                                </option>
                                            </select></div>
                                        <div class="clear"></div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-4"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-pane fade" id="nav-notification" role="tabpanel"
                 aria-labelledby="nav-notification-tab">
                <div class="row" style="border: 0px solid gray">
                    <div class="col-3">&nbsp;</div>
                    <div class="col-9" style="border:0px solid red;">
                        <div class="row">
                            <div class="col-8">
                                Notification
                            </div>
                            <div class="col-4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-newsletter" role="tabpanel"
                 aria-labelledby="nav-newsletter-tab">
                <div class="row" style="border: 0px solid gray">
                    <div class="col-3">&nbsp;</div>
                    <div class="col-9" style="border:0px solid red;">
                        <div class="row">
                            <div class="col-8">
                                Newsletter
                            </div>
                            <div class="col-4"></div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="nav-connection" role="tabpanel"
                 aria-labelledby="nav-connection-tab">

                <div class="row" style="border: 0px solid gray">
                    <div class="col-3">&nbsp;</div>
                    <div class="col-9" style="border:0px solid red;">
                        <div class="row">
                            <div class="col-8">
                                Connection
                            </div>
                            <div class="col-4"></div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="tab-pane fade" id="nav-account" role="tabpanel" aria-labelledby="nav-account-tab">

                <div class="row" style="border: 0px solid gray">
                    <div class="col-3">&nbsp;</div>
                    <div class="col-9" style="border:0px solid red;">
                        <div class="row">
                            <div class="col-8">
                                Account
                            </div>
                            <div class="col-4"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

