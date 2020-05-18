@extends('layouts.client_app')

@section('client_content')
    <style>
        .modal-content {
            margin-top: 150px !important;
        }
        .external-image-thumbnail {
            display: block;
            max-width: 4.5rem;
        }
    </style>
    <div id="myVideo">
        <div class="row" style="border: 0px solid gray">
{{--            <div class="col-1">&nbsp;</div>--}}
            <div class="col-12" style="border:0px solid red;">
                <hr>
                <div v-if="myVideos.length == 0">
                    <h4>No Video available in your list. for uploading click <a :href="/upload/">Here</a></h4>
                </div>
                <div class="col-12">
{{--                    @{{myVideos}}--}}
                    <table class="table table-bordered">
                        <tr>
                            <td>Thumbnail</td>
                            <td>Title</td>
                            <td>Artist</td>
                            <td>Genre</td>
                            <td>Uploaded At</td>
                            <td>Earned($)</td>
                            <td>Actions</td>
                        </tr>
                    <tr  v-for="child_content in myVideos" style="border: 1px solid red;">
                        <td><a :href="'/watch/'+child_content.hash_id"><img class="external-image-thumbnail text-left" :src="child_content.image"></a></td>
                        <td><a :href="'/video/'+child_content.hash_id+'/'+child_content.id" title="Click here for update information.">@{{child_content.title}}</a></td>
                        <td>@{{child_content.artistname}}</td>
                        <td>@{{child_content.genres_name}}</td>
                        <td>@{{child_content.created_date}}</td>
                        <td><a class="" :href="'/transactions/'+child_content.hash_id+'/'+child_content.id" style="cursor: pointer;font-weight: bold;text-decoration: underline" title="Transaction Details.">
                                <span v-if="child_content.earning_transaction_total.length == 0">$0</span>
                                <span v-if="child_content.earning_transaction_total.length > 0">
                                    $@{{ child_content.earning_transaction_total[0].total }}
                                    </span>


                            </a></td>
                        <td>

                            <a class="" v-if="child_content.status == 1" style="cursor: pointer;font-weight: bold;text-decoration: underline" @click="videoPublishUnPublish(child_content.id,0)"><i  style="font-size: 20px;" class="fa fa-adjust" title="Un-Publish"></i></a>
                            <a class="" v-if="child_content.status == 0"style="cursor: pointer;font-weight: bold;text-decoration: underline" @click="videoPublishUnPublish(child_content.id,1)"><i  style="font-size: 20px;" class="fa fa-window-restore" title="Publish"></i></a>
                            <a class="" style="cursor: pointer;text-decoration: underline"@click="mediaStates(child_content.hash_id)"><i  style="font-size: 20px;" class="fa fa-address-card" title="State"></i></a> </a>
                            <a class="" v-if="child_content.status == 2"
                               style="cursor: pointer; font-weight: bold;text-decoration: underline"
                               href="#">Banned |</a>
                            <a  title="Delete" class="" v-if="child_content.status != 2"style="cursor: pointer;font-weight: bold;text-decoration: underline" @click="videoDelete(child_content.id,child_content.hash_id)">
                                <i class="fa fa-remove"alter="Delete" title="Delete"></i></a>
                        </td>

                    </tr>
                    </table>

                </div>
            </div>

            <div class="container" id="ContentLoad">
                <!-- Modal -->
                <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                Video States
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body" id="modalContent">
                                <table class="table" width="100%">
                                    <tr>
                                        <td>Average Engagement</td>
                                        <td>@{{videoStats.averagePercentWatched}} %</td>
                                    </tr>
                                    <tr>
                                        <td>Total Play</td>
                                        <td>@{{videoStats.plays}} time(s)</td>
                                    </tr>
                                    <tr>
                                        <td>Total Visitors</td>
                                        <td>@{{videoStats.visitors}} %</td>
                                    </tr>
                                    <tr>
                                        <td>Clicking Play</td>
                                        <td>@{{videoStats.percentOfVisitorsClickingPlay}} %</td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script type="text/javascript">

        new Vue({
            el: '#myVideo',
            mounted() {
                axios.get("/myVideos/")
                    .then(response => (this.myVideos = response.data))
                    .catch(function (response) {
                        console.log('Error', response)
                    })
            },
            data: {
                myVideos: [],
                videoStats: []
            },
            methods: {

                videoPublishUnPublish: function (id, status) {
                    message = (status == 1) ? "Publish":"Un-Publish";
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to ("+ message +") the video ",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, do it'
                    }).then((result) => {
                        if (result.value) {

                            axios.post('/mediaStatusUpdate', {
                                id: id,
                                status:status
                            })
                                .then(response => (this.myVideos = response.data))

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
                                title: 'Your operation successfully done'
                            })
                        }
                    })
                },
                videoDelete: function (id,hash_id) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You want to delete the video ",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it'
                    }).then((result) => {
                        if (result.value) {

                            axios.post('/mediaDelete', {
                                id: id,
                                hashId:hash_id
                            })
                                .then(response => (this.myVideos = response.data))

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
                                title: 'Your operation successfully done'
                            })
                        }
                    })
                },
                mediaStates:function(mediaHashId){
                    var self = this;
                    axios.get('/VideoStates/'+mediaHashId)
                        .then(function (response) {
                            self.videoStats = response.data.stats;
                            $("#myModal").modal('show');
                        })
                }
            }
        })
    </script>
@endsection

