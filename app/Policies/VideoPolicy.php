<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function delete(){
        return FALSE;
    }


    public function view(){
        return TRUE;
    }

    public function update(){
        return TRUE;
    }
}
