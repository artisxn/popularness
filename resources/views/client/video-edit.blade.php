@extends('layouts.client_app')

@section('client_content')
    <div class="row" style="border: 0px solid gray">
        <div class="col-1">&nbsp;</div>
        <div class="col-10" style="border:0px solid red;">
            <div class="row" style="margin-top: 50px;">
                <div class="col-12">
                    <div class="panel-body" style="border: 0px solid red">
                        <form method="POST" action="{{ route('video-info-update') }}">
                            <fieldset>
                                <legend>Video Update</legend>
                                @csrf
                                <div class="form-group">
                                    <input type="hidden" value="{{$video->hash_id.'-'.$video->id}}" name="hash_id">
                                    <div class="input text">
                                        @error('title')
                                        <input id="title" type="text"
                                               class="form-control @error('title') is-invalid @enderror"
                                               name="title"
                                               value="{{ old('title') }}" required
                                               autocomplete="title"
                                               autofocus>
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                        @else
                                            <input id="title" type="text" class="form-control"
                                                   name="title"
                                                   value="{{$video->title}}"
                                                   required
                                                   autocomplete="title" placeholder="Title"
                                                   autofocus>
                                            @enderror

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input text">

                                        @error('artist')
                                        <input id="artist" type="text"
                                               class="form-control @error('artist') is-invalid @enderror"
                                               name="artist"
                                               value="{{ old('artist') }}" required
                                               autocomplete="artist"
                                               autofocus>
                                        <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                        @else
                                            <input id="artist" type="text" class="form-control"
                                                       name="artist"
                                                   value="{{$video->artistname}}"
                                                   required
                                                   autocomplete="artist" placeholder="Artist / Brand Name"
                                                   autofocus>
                                            @enderror

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input select">

                                        <select name="UserPrimaryGenre" class="selectpicker form-control">
                                            <option value="">Select Primary Genre</option>
                                            @foreach($genres as $genre)
                                                <option value="{{$genre->id}}" {{($genre->id == $video->genres) ? 'selected':''}}>{{$genre->genre}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="card-overlay position-relative">
                                    <div class="ovarlay position-absolute">
                                        <ul>
                                            <li><a href="{{url("/watch")."/".$video->hash_id}}"><i
                                                            class="fa fa-play"
                                                            aria-hidden="true"></i></a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                    <img class='card-img-top' src="{{$video->image}}">
                                </div>
                                <div class="row">&nbsp;</div>
                                <div class="row">
                                    <div class="col-6"></div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <button type="submit" style="cursor: pointer" class="btn btn-success signupartistfanbtn">Update</button>
                                        </div>

                                    </div>
                                </div>

                            </fieldset>
                        </form>


                    </div>
                </div>
            </div>
            <hr>
@endsection

