<div class="container">
    @foreach ($contents as $child_content)
        <div class="row">
            @foreach($child_content as $content)

                <div class="col-4">
                    @if ($loop->first)
                        <h2 class="title-date">{{$content->created_date}}</h2>
                        @else
                        <h2 class="title-date">&nbsp;</h2>
                    @endif
                    <div class="card wow fadeIn video-thumb">
                        <div class="card-overlay position-relative">
                            <div class="ovarlay position-absolute">
                                <ul>
                                    <li><a href="{{url("/watch")."/".$content->hash_id}}"><i class="fa fa-play"
                                                                                 aria-hidden="true"></i></a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <img class='card-img-top' src="{{$content->image}}">
                        </div>
                        <div class="card-body">
                            <h3>{{$content->title}}</h3>
                            <h5>{{$content->artistname}} </h5>
                            <p class="genre">{{$content->genres_name}}</p>

                            <p class="view">{{$content->views}} views</p>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>