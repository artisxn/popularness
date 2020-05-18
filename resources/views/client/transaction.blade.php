@extends('layouts.client_app')

@section('client_content')
    <style>
        .modal-content {
            margin-top: 150px !important;
        }

        .external-image-thumbnail {
            display: block;
            max-width: 6rem;
        }
    </style>
    <div id="myVideo">
        <div class="row" style="border: 0px solid gray">

            <div class="col-12" style="border:0px solid red;">
                <div class="row">
                    <table class="table table-borderless">
                        <tr>
                            <td>Title</td>
                            <td>{{$videoInfo->title}}</td>
                        </tr>
                        <tr>
                            <td>Artist</td>
                            <td>{{$videoInfo->artistname}}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>
                                @if($videoInfo->status == 1)
                                    Published
                                @elseif($videoInfo->status == 0)
                                    Un-Published
                                @else
                                    Banned
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Video</td>
                            <td>
                                <iframe src="//fast.wistia.net/embed/iframe/{{$videoInfo->hash_id}}"
                                        allowtransparency="true" frameborder="0" scrolling="no"
                                        class="wistia_embed" name="wistia_embed"
                                        allowfullscreen mozallowfullscreen webkitallowfullscreen oallowfullscreen
                                        msallowfullscreen
                                        width="50%" height="100%"></iframe>
                            </td>
                        </tr>
                    </table>
                </div>
                <hr>

                <div class="col-12">
                    @if(count($transactions)== 0)
                        <h4> No Transaction found on the Video.</h4>
                    @else
                        <div>
                            <h4>Transaction Logs.</h4>
                        </div>
                        <table class="table table-bordered">
                            <tr>
                                <td>Donated On</td>
                                <td>Amount</td>
                            </tr>
                            @php($total = 0.00)
                            @foreach ($transactions as $child_content)
                                <tr>
                                    @foreach ($child_content as $content)
                                        <td> {{ date('F jS, Y, g:i a', strtotime($content->created_at)) }}</td>
                                        <td>${{$content->amount}}</td>
                                        @php($total +=$content->amount)
                                    @endforeach

                                </tr>

                            @endforeach
                            <tr>
                                <td class="text-right" >Total:</td>
                                <td>${{$total}} </td>
                            </tr>
                        </table>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection

