<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Actions\Actionable;

class Genre extends Model
{
    use Actionable;

    public function video(){
        return $this->hasMany('App\Video','genres');
    }
}
