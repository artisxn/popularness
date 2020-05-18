@extends('layouts.client_app')
@section('client_content')
    <div class="row">
        <div class="col-5"></div>
        <div class="col-2"><p>SUBSCRIPTION</p></div>
        <div class="col-4"></div>
    </div>
    <hr>
    <div class="col-12">
        <div class="row">
            <div class="@if($package->price < 1)col-12 @else col-6 @endif" >
{{--            <div class="col-6 " >--}}
                <div class="row">
                    <div class="col-6" ><b>Your Subscription</b></div>
                    <div class="col-6" ><a  href="{{route('change-subscription')}}" style="text-decoration: underline;cursor: pointer">Change Subscription</a></div>
                </div>

                <div class="row" style="border-top: 1px solid gray"></div>
                <div class="row"> &nbsp;</div>
                <div class="row">
                    <div class="col-12">
                        Package: {{$package->name}}
                    </div>
                </div>
                <div class="row"> &nbsp;</div>

                <div class="row" style="padding: 8px;border-bottom: 1px dotted gray;"><img  style="width:15px;height: 20px;" class="check_check" src="{{asset('images/Check-mark50.png')}}"> &nbsp;Artist/Band Profile</div>
                <div class="row" style="padding: 8px;border-bottom: 1px dotted gray;"><img  style="width:15px;height: 20px;" class="check_check" src="{{asset('images/Check-mark50.png')}}"> &nbsp;{{$package->monthly_upload}} Upload per month</div>
                <div class="row" style="padding: 8px;border-bottom: 1px dotted gray"><img  style="width:15px;height: 20px;" class="check_check" src="{{asset('images/Check-mark50.png')}}"> &nbsp;{{$package->total_storage / 1024}} GB Total Storage</div>
                <div class="row" style="padding: 8px;border-bottom: 1px dotted gray">
                    @if($package->chart_option == 1)
                        <img  style="width:15px;height: 20px;" class="check_check" src="{{asset('images/Check-mark50.png')}}"> &nbsp; Music Video Charting
                    @else
                        <del>Music Video Charting</del>
                    @endif
                </div>
                <div class="row" style="padding: 8px;border-bottom: 1px dotted gray">
                    @if($package->analytics == 1)
                        <img  style="width:15px;height: 20px;" class="check_check" src="{{asset('images/Check-mark50.png')}}"> &nbsp;Global Video Analytics
                    @else
                        <del>Global Video Analytics</del>
                    @endif
                </div>
                <div class="row" style="padding: 8px;border-bottom: 1px dotted gray">
                    @if($package->report_enable == 1)
                        <img  style="width:15px;height: 20px;" class="check_check" src="{{asset('images/Check-mark50.png')}}"> &nbsp; Performance Report
                    @else
                        <del>Performance Report</del>
                    @endif

                </div>
                <div class="row" style="padding: 8px;border-bottom: 1px dotted gray">
                    @if($package->video_monetize == 1)
                        <img  style="width:15px;height: 20px;" class="check_check" src="{{asset('images/Check-mark50.png')}}"> &nbsp; Monetize your Videos
                    @else
                        <del>Monetize your Videos</del>
                    @endif

                </div>

            </div>
            <div class="col-1"></div>
            @if($package->price > 0)
            <div class="col-5">
                <div class="row">
                    <div class="col-8" ><b>Your Payment Info</b></div>
                    <div class="col-4" ><a style="text-decoration: underline;cursor: pointer">Update Card</a></div>
                </div>
                <div class="row" style="border-top: 1px solid gray"></div>
                <div class="row"> &nbsp;</div>
                <div class="row" style="padding:8px;border-bottom: 1px dotted gray">Next Bill Date: </div>
                <div class="row" style="padding:8px;border-bottom: 1px dotted gray">Name on Card: </div>
                <div class="row" style="padding:8px;border-bottom: 1px dotted gray">Card # : </div>
                <div class="row" style="padding:8px;border-bottom: 1px dotted gray">Exp Date  : </div>
            </div>
                @endif
        </div>




    </div>
@endsection
