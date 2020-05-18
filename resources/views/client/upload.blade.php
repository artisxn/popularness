@extends('layouts.client_app')

@section('client_content')
    <script src="http://malsup.github.com/jquery.form.js"></script>
    <div class="row" style="border: 0px solid gray">
        <div class="col-1">&nbsp;</div>
        <div class="col-10" style="border:0px solid red;">
            <div class="row" style="margin-top: 50px;">
                <div class="col-12">
                    <div class="panel-body" style="border: 0px solid red">
                        <form>
                            <fieldset>
                                <legend>Video Upload</legend>
                                @csrf
                                <div class="form-group">
                                    <div class="input text">
                                        @error('first_name')
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
                                                   required
                                                   autocomplete="artist" placeholder="Artist / Brand Name"
                                                   autofocus>
                                            @enderror

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input select">

                                        <select name="UserPrimaryGenre" class="selectpicker form-control"
                                                id="UserPrimaryGenre">
                                            <option value="">Select Primary Genre</option>
                                            @foreach($genres as $genre)
                                                <option value="{{$genre->id}}" >{{$genre->genre}}</option>
                                            @endforeach

                                        </select></div>
                                </div>
                            </fieldset>
                        </form>
                        <script src="//fast.wistia.com/assets/external/api.js" async></script>
                        <link rel="stylesheet" href="//fast.wistia.com/assets/external/uploader.css"/>
                        <div id="wistia_uploader" style="height:360px;width:640px;"></div>

                    </div>
                </div>
            </div>
        </div>
        <script>

            $(document).ready(function(){
                var wistiaAccessToken = '{{ env('WISTIA_API_KEY') }}';
                var projectId = "{{ Auth::user()->project_id}}";
                media = {};
                window._wapiq = window._wapiq || [];

                _wapiq.push(function (W) {

                    window.wistiaUploader = new W.Uploader({
                        accessToken: wistiaAccessToken,
                        dropIn: "wistia_uploader",
                        projectId: projectId,

                        //onBeforeUnload: false
                        beforeUpload: function(file) {
                            mediaSize = file.size;
                            return new Promise(function(resolve, reject) {
                                checkingStatus = true;
                                // Need to check required field
                                if($("#title").val() == '' || $("#artist").val() == '' || $('#UserPrimaryGenre option:selected').val() == ''){
                                    alert('Oops! Some fields are required for Video uploading!');
                                    checkingStatus = false;
                                    reject();
                                }

                                if(checkingStatus){
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    $.ajax({
                                        data: {
                                            size: mediaSize,
                                        },
                                        url: "/videoLimitCheck",
                                        type: "POST",
                                        dataType: 'json',
                                        cache : false,
                                        success: function (res) {
                                            if(res.status == 'error'){
                                                alert(res.message);
                                                reject();
                                                $("#title").val("");
                                                $("#artist").val("");
                                                $('#UserPrimaryGenre').val("");
                                            }else{
                                                resolve();
                                                console.log(res.message);
                                            }

                                        }
                                    });
                                }
                            });
                        }
                    });

                    wistiaUploader.bind("uploadcancelled", function(file) {
                        console.log("We are no longer uploading " + file.name);
                    });

                    wistiaUploader.bind('uploadsuccess', function (file, media) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            data: {
                                title: $("#title").val(),
                                artist: $("#artist").val(),
                                primary_genre: $('#UserPrimaryGenre option:selected').val(),
                                wistia: media,
                                size: file.file.data.size,
                                type: file.file.data.type,
                            },
                            url: "/videoDataSave",
                            type: "POST",
                            dataType: 'json',
                            cache : false,
                            success: function (data) {
                                $("#title").val("");
                                $("#artist").val("");
                                $('#UserPrimaryGenre').val("");
                            }
                        });

                    });
                });
            });
        </script>
@endsection

