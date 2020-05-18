<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPlayList extends Model
{

    protected $table = 'user_play_lists';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','name','status','hash_id'];

}
