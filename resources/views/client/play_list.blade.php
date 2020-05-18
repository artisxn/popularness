@extends('layouts.client_app')
@section('client_content')
    <style>
        .modal-content {
            margin-top: 150px !important;
        }

    </style>
    <div id="clientPlayList">
        <div class="row">
            <div class="col-5"></div>
            <div class="col-2"><p>My Play List</p></div>
            <div class="col-4"></div>
        </div>
        <hr>
        <div class="col-12">
            <ol style="font-size: 25px;list-style: none">
                <li v-for="playList in playListContent">
                    <i class="fa fa-list-alt"></i> &nbsp;<a :href="'/viewPlayList/'+ playList.hash_id"
                                                            :id="'playList_'+playList.id">@{{playList.name}}</a>
                    &nbsp;
                    &nbsp;<a @click="playListEdit(playList.id,playList.name)"
                             style="font-size: 15px;color: green;cursor: pointer"><i class="fa fa-pencil"
                                                                                     alter="Edit play list"></i></a>
                    &nbsp;<a @click="playListDelete(playList.id)"
                             style="font-size: 15px;color: red;cursor: pointer"><i class="fa fa-remove"
                                                                                   alter="Delete play list"></i></a>
                    <br>
                </li>
            </ol>
        </div>

        <div class="container" id="ContentLoad">
            <!-- Modal -->
            <div class="modal fade" id="playListModal" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            Play List
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body" id="playListModalContent">
                            <input type='hidden' id="PlayListId">
                            <input type='text' class='form-control' maxlength='100' name='playListName'
                                   id='playListName' placeholder='Enter Play List Name' required>
                        </div>
                        <div class="modal-footer">
                            <p><a class="btn btn-success" @click="playListUpdate()">Update</a></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        new Vue({
            el: '#clientPlayList',
            mounted() {
                axios.get('/myPlayListData')
                    .then(response => (this.playListContent = response.data))
            },
            data: {
                playListContent: [],

            },
            methods: {

                playListEdit: function (id) {
                    $("#playListName").val($("#playList_" + id).text());
                    $("#PlayListId").val(id);
                    $("#playListModal").modal('show');
                },

                playListUpdate: function () {
                    id = $("#PlayListId").val();
                    playListName = $("#playListName").val();

                    axios.post('/playListUpdate', {
                        id: id,
                        playListName: playListName,
                    })
                        .then(function (response) {
                            console.log(response,'hello');

                            $("#playList_" + id).text(playListName);
                            $('#playListModal').modal('hide');

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
                                icon: response.data.status,
                                title: response.data.message
                            })
                        })
                },

                playListDelete: function (id) {

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {

                            axios.post('/playListDelete', {
                                id: id,
                            })
                                .then(response => (this.playListContent = response.data))
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
            }
        })

    </script>
@endsection
