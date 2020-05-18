<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class GenrePolicy
{
    use HandlesAuthorization;



    public function create(){
        return TRUE;
    }

    public function view(){
        return TRUE;
    }


    public function update(){
        return TRUE;
    }

}
