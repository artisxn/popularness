<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoPlayList extends Model
{
    protected $table='video_playlists';

    protected $fillable = ['play_list_id','video_id','status'];
}
