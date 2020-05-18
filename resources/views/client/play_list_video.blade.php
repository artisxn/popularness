@extends('layouts.client_app')
@section('client_content')

    <div class="row" style="border: 0px solid gray" id="playListDetails">
        <div class="col-1">&nbsp;</div>
        <div class="col-10" style="border:0px solid red;">
            <hr>
            <div class="col-12">
                <input type="hidden" id="playListHashId" value="{{$hash_id}}">

                <div v-if="playListVideos.length == 0">
                    <h4>No Video added in the play List</h4>
                    <a href="{{url('/playList')}}" CLASS="btn btn-primary">RETURN TO PALY LIST</a>
                </div>

                <div class="row"  v-for="child_content in playListVideos">

                    <div class="col-4" v-for="(content,index) in child_content" >
                            <h6 class="title-date" v-if="index==0">@{{content.created_date}}</h6>
                            <h6 class="title-date" v-if="index!=0">&nbsp;</h6>
                        <div class="card wow fadeIn video-thumb">
                            <div class="card-overlay position-relative">
                                <div class="ovarlay position-absolute">
                                    <ul>
                                        <li>
                                            <a v-bind:href="'/watch/'+content.hash_id">
                                                <i class="fa fa-play" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                                <img class='card-img-top' v-bind:src="content.image">
                            </div>
                            <div class="card-body">
                                <small>@{{content.title}}</small>
                                <br>
                                <small>@{{content.artistname}} </small>
                                <br>
                                <small>@{{content.genres_name}}</small>
                                <br>
                                <small>@{{content.views}} views</small>
                                <br>
                                <a class="btn btn-danger" style="cursor: pointer;color: white" v-on:click="removeVideoFromPlayList(content.video_play_list_pk,content.playListId)">Remove</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

    <script type="text/javascript">

        hashId = $("#playListHashId").val();

        new Vue({
            el:'#playListDetails',
            mounted(){
                axios.post("/playListVideo/"+hashId)
                    .then(response => (this.playListVideos = response.data))
                    .catch(function (response){
                        console.log('Error',response)
                    })
            },
            data:{
                playListVideos:[]
            },
            methods:{
                removeVideoFromPlayList :function (id,playListId) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to delete from the play list!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, remove it!'
                    }).then((result) => {
                        if (result.value) {

                            axios.post('/removeVideoFromPlayList',{
                                id:id,
                                playListId:playListId
                            })
                                .then(response=>(this.playListVideos = response.data))

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'bottom-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                onOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Successfully remove from the play list'
                            })
                        }
                    })
                }
            }
        })

    </script>

@endsection

