<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Actions\Actionable;

class Package extends Model
{

    use SoftDeletes,Actionable;

    public function users(){
        return $this->hasMany('App\User');
    }
}
