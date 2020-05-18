@extends('layouts.app')
@section('content')
    <style>
        .modal-content {
            margin-top: 250px;
        }
    </style>

    <div id="videoWatchPage">
        <div class="container" style="border: 0px solid red">
            <div class="row container" style="height: 400px; ">
                <div class="col-9">
                    <div class="row" style="border: 0px solid gray;height: 350px">
                        <iframe src="//fast.wistia.net/embed/iframe/{{$videoIframe}}"
                                allowtransparency="true" frameborder="0" scrolling="no"
                                class="wistia_embed" name="wistia_embed"
                                allowfullscreen mozallowfullscreen webkitallowfullscreen oallowfullscreen
                                msallowfullscreen
                                width="100%" height="100%"></iframe>

                    </div>
                    <div class="row"
                         style="text-align: center;border-left:1px solid gray;border-bottom:1px solid gray;border-right:1px solid gray;height: 30px">
                        <div class="col-3" style="border-right: 1px solid gray">
                            <a style="cursor: pointer;" @click="addPlayList()">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add Play List
                            </a>
                        </div>
                        <div class="col-2" style="border-right: 1px solid gray">
                            <a style="cursor: pointer;{{$favouriteStatus}}" id="favouriteId" @click="addFavourite()">
                                <i class="fa fa-heart" aria-hidden="true"></i> Love
                            </a>

                        </div>
                        <div class="col-2" style="border-right: 1px solid gray">
                            <a style="cursor: pointer;" id="favouriteId" @click="linkShare()">
                                <i class="fa fa-share-square-o" aria-hidden="true"></i> Share
                            </a>

                        </div>
                        <div class="col-2" style="border-right: 1px solid gray"><i class="fa fa-credit-card-alt"
                                                                                   aria-hidden="true"></i> Credits
                        </div>
                        <div class="col-2"><i class="fa fa-download" aria-hidden="true"></i> Downloads</div>
                    </div>
                </div>
                <div class="col-3" style="border: 0px solid gray">
                    <div class="row">
                        <div class="col-2"></div>
                        <div class="col-8">
                            <div class="row" style="height: 20px;"> &nbsp;</div>
                            <div class="row">
                                <h2>@{{count}}&nbsp;</h2><span style="margin-top: 10px">SUPPORTER(S)</span>
                            </div>
                            <div class="row">
                                <h2> $@{{amount}}&nbsp;</h2> <span style="margin-top: 10px;">USD</span>
                            </div>
                            <div class="row">
                                <small>PLEDGED IN APPRECIATION</small>
                            </div>

                        </div>
                        <div class="col-2"></div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-2"></div>

                    @guest
                            <div class="col-10">
                                <div class="row">
                                    <p>Select a contribution amount:</p>
                                    <p><input type="radio" name="contributeAmount" id="contributeAmount1"
                                              value="{{$videoPolicy->min_amount}}" @click="selectContributionOption(1)"><span> ${{$videoPolicy->min_amount}}&nbsp;</span>
                                        <input type="radio" name="contributeAmount" id="contributeAmount2"
                                               value="{{$videoPolicy->max_amount}}"
                                               @click="selectContributionOption(2)"> <span> ${{$videoPolicy->max_amount}}&nbsp;</span>
                                    </p>
                                    <p>
                                        <input type="radio" name="contributeAmount" id="contributeAmount3"
                                               @click="selectContributionOption(4)">
                                        <input type="number" :disabled="validated == 1" v-model="customInput"
                                               style="text-align: right" id="contributeAmount4"
                                               placeholder="Between {{$videoPolicy->min_amount}} and {{$videoPolicy->max_amount}}">
                                    </p>
                                    <button class="btn btn-success" :disabled="supportButton== false" @click="doContribution()"
                                            style="width: 100%;cursor: pointer">SUPPORT
                                    </button>
                                </div>
                            </div>
                    @else
                        <!-- User can't donate in own video-->
                            @if(!empty($videoPolicy) & $videoUserId != auth::user()->id)
                                <div class="col-10">
                                    <div class="row">
                                        <p>Select a contribution amount:</p>
                                        <p><input type="radio" name="contributeAmount" id="contributeAmount1"
                                                  value="{{$videoPolicy->min_amount}}" @click="selectContributionOption(1)"><span> ${{$videoPolicy->min_amount}}&nbsp;</span>
                                            <input type="radio" name="contributeAmount" id="contributeAmount2"
                                                   value="{{$videoPolicy->max_amount}}"
                                                   @click="selectContributionOption(2)"> <span> ${{$videoPolicy->max_amount}}&nbsp;</span>
                                        </p>
                                        <p>
                                            <input type="radio" name="contributeAmount" id="contributeAmount3"
                                                   @click="selectContributionOption(4)">
                                            <input type="number" :disabled="validated == 1" v-model="customInput"
                                                   style="text-align: right" id="contributeAmount4"
                                                   placeholder="Between {{$videoPolicy->min_amount}} and {{$videoPolicy->max_amount}}">
                                        </p>
                                        <button class="btn btn-success" :disabled="supportButton== false" @click="doContribution()"
                                                style="width: 100%;cursor: pointer">SUPPORT
                                        </button>
                                    </div>
                                </div>
                            @endif
                    @endguest



                    </div>
                </div>
            </div>

        </div>
        <div class="container" style="margin: 5px">&nbsp;</div>
        <div class="container">
            <p>Published on November 24,2014</p>
        </div>
        <hr>

        <div class="container" id="ContentLoad">
            <!-- Modal -->
            <div class="modal fade" id="favouriteModal" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body" id="favouriteModalContent">
                            <p>Sign in to add this video to a favourite list .</p>
                        </div>
                        <div class="modal-footer">
                            <p><a href="{{url('/login')}}">SIGN IN</a></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="container" id="ContentLoad">
            <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            Save to...
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body" id="modalContent">
                            <p v-if="signIn">Sign in to add this video to a playlist.</p>
                            <div v-if="!signIn">
                                <li style='list-style: none' v-for="list in myPlayList">
                                    <input type="checkbox" id="checkbox" v-model="list.check_status"
                                           @click="UpdatePlayList(list.id)"> @{{list.name}}
                                </li>
                                <hr>
                                <input type='text' class='form-control' v-model="playListName" maxlength='100'
                                       placeholder='Enter Play List Name' required>
                                <p v-if="error" style="font-style:italic;color: red;font-size: small">
                                    *@{{errorMessage}}</p>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <p v-if="signIn"><a href="{{url('/login')}}">SIGN IN</a></p>
                            <a v-if="!signIn" href='#' @click='createPlayList()'>CREATE</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="container" id="linkShareModal">
            <!-- Modal -->
            <div class="modal fade" id="linkShareModalInner" role="dialog">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body" id="linkShareModalInnerInner">
                            <input type='text' class='form-control' v-model="currentUrl" id="myInput"
                                   placeholder='Enter Play List Name' required>
                            <div class="modal-footer">
                                <button class="btn" @click="copiedLink()">COPY LINK</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        <div class="container">

            <script id="dsq-count-scr" src="//popularness-com.disqus.com/count.js" async></script>

            <div class="row">
                <div class="col-9">
                    <div id="disqus_thread"></div>
                    <script>

                        /**
                         * RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                         * LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                        /*
                        var disqus_config = function () {
                        this.page.url = PAGE_URL; // Replace PAGE_URL with your page's canonical URL variable
                        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                        };
                        */
                        (function () { // DON'T EDIT BELOW THIS LINE
                            var d = document, s = d.createElement('script');
                            s.src = 'https://popularnesss.disqus.com/embed.js';
                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                        })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments
                            powered by Disqus.</a></noscript>
                </div>

                <div class="col-3" style="border: 0px solid green;">
                    @foreach($contents as $content)
                        <div class="row">
                            <div class="col-6" style="border: 0px solid red">
                                <div class="card-overlay position-relative">
                                    <div class="ovarlay position-absolute" style="margin-left: 98px;">
                                        <ul>
                                            <li><a href="{{url("/watch")."/".$content->hash_id}}"><i class="fa fa-play"
                                                                                                     aria-hidden="true"></i></a>
                                            </li>
                                            <li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
                                        </ul>
                                    </div>
                                    <img class='card-img-top' src="{{$content->image}}">
                                </div>
                            </div>
                            <div class="col-6">
                                <small>{{$content->title}}</small>
                                <br>
                                <small>{{$content->artistname}}</small>
                                <br>
                                <small>{{$content->genres_name}}</small>
                                <p class="view">{{$content->views}} views</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var videoId = '{{$videoId}}';

        new Vue({
            el: '#videoWatchPage',
            mounted(){
                self = this;
                axios.get('/getVideoTransactions/'+videoId)
                    .then(function (response) {
                        self.count = response.data.count;
                        self.amount = response.data.amount;

                    })
            },
            data: {
                currentUrl: window.location.href,
                count:0,
                amount:0,
                myPlayList: [],
                signIn: true,
                playListName: '',
                error: false,
                errorMessage: '',
                selectedAttribute: '',
                validated: true,
                customInput: '',
                supportButton:false,
            },
            methods: {
                copiedLink:function(){
                    var copyText =  document.getElementById("myInput");;
                    copyText.select();
                    copyText.setSelectionRange(0, 99999)
                    document.execCommand("copy");
                    alert("Copied the text: " + copyText.value);
                },
                linkShare:function(){
                    $("#linkShareModalInner").modal('show');

                },
                selectContributionOption: function (id) {
                    this.selectedAttribute = "contributeAmount" + id;
                    this.validated = true;
                    this.supportButton = true;
                    if (id == 4) {
                        this.validated = false;
                    } else {
                        this.customInput = '';
                    }
                },
                doContribution: function () {
                    self = this;
                    var minAmount = '{{$videoPolicy->min_amount}}';
                    var maxAmount = '{{$videoPolicy->max_amount}}';
                    var userAuthenticate = '{{Auth::check()}}';
                    if (!userAuthenticate) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Sign is required to contribution',
                            footer: "<a href='/login'> Sign In</a>"
                        })
                        return;
                    }
                    if (this.selectedAttribute == "") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Please select a contribution option',
                        })
                        return;
                    }
                    if (this.selectedAttribute == 'contributeAmount4') {
                        seletedAmount = parseFloat($("#" + this.selectedAttribute).val());
                    } else {
                        seletedAmount = $('input[name=contributeAmount]:checked').val();
                    }
                        if (seletedAmount == "" || seletedAmount < minAmount || seletedAmount > maxAmount) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "Please enter amount Between $" + minAmount + " and $" + maxAmount + " ",
                        })
                        return;
                    }
                    Swal.fire({
                        title: "Are you sure ?",
                        text: "You want to contribute $"+seletedAmount+" on the video",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, contribute it!'
                    }).then((result) => {
                        if (result.value) {
                            axios.post('/videoContribution', {
                                videoId: videoId,
                                amount: seletedAmount
                            })
                                .then(function (res) {
                                    response = res.data;
                                    if(response.status == 'success'){
                                        self.count =response.count;
                                        // self.amount= parseFloat(self.amount)+parseFloat(seletedAmount);
                                        self.amount= response.amount;
                                    }
                                    Swal.fire({
                                        icon: response.status,
                                        title: '',
                                        text: response.message,
                                        footer: "<a href='/balance'> Check Balance</a>"
                                    })

                                })
                        }
                    })

                },
                addPlayList: function () {
                    this.error = false;
                    this.playListName = '';
                    var userAuthenticate = '{{Auth::check()}}';
                    if (!userAuthenticate) {
                        $("#myModal").modal('show');
                        return;
                    }
                    var self = this;
                    axios.post('/VideoPlayList', {
                        videoId: videoId
                    })
                        .then(function (response) {
                            self.myPlayList = response.data;
                            self.signIn = false;
                            $("#myModal").modal('show');
                        })
                },

                createPlayList: function () {

                    if (this.playListName == "") {
                        this.error = true;
                        this.errorMessage = 'Play List field is required!';
                        return;
                    }
                    var self = this;
                    axios.post('/CreatePlayList', {
                        videoId: videoId,
                        playListName: self.playListName
                    })
                        .then(function (response) {
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
                                title: 'Play List created successfully done'
                            })
                            $('#myModal').modal('hide');
                        })

                },
                UpdatePlayList: function (playListId) {
                    axios.post('/UpdateVideoPlayList', {
                        videoId: videoId,
                        playListId: playListId
                    })
                        .then(function (response) {
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
                                title: 'Play List updated successfully done'
                            })
                        })
                },

                addFavourite: function () {
                    var userAuthenticate = '{{Auth::check()}}';
                    if (!userAuthenticate) {
                        $("#favouriteModal").modal('show');
                        return;
                    }

                    axios.post('/VideoFavourite', {
                        videoId: videoId
                    })
                        .then(function (res) {
                            if (res.data.favourite_status == 1) {
                                var favouriteSuccessMessage = "You successfully added to your favourite list.";
                                $("#favouriteId").css("color", "red");
                            } else {
                                var favouriteSuccessMessage = "You successfully removed from your favourite list.";
                                $("#favouriteId").css("color", "black");
                            }
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
                                title: favouriteSuccessMessage
                            })
                        })
                }
            }
        })

    </script>

@endsection
