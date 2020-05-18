<?php

namespace App\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any video policies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny()
    {
        return TRUE;
    }

    /**
     * Determine whether the user can view the video policy.
     *
     * @param  \App\User  $user
     * @param  \App\VideoPolicy  $videoPolicy
     * @return mixed
     */
    public function view()
    {
        return TRUE;
    }

    /**
     * Determine whether the user can create video policies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create()
    {
        return FALSE;
    }

    /**
     * Determine whether the user can update the video policy.
     *
     * @param  \App\User  $user
     * @param  \App\VideoPolicy  $videoPolicy
     * @return mixed
     */
    public function update()
    {
        return TRUE;
    }

    /**
     * Determine whether the user can delete the video policy.
     *
     * @param  \App\User  $user
     * @param  \App\VideoPolicy  $videoPolicy
     * @return mixed
     */
    public function delete()
    {
        return FALSE;
    }

    /**
     * Determine whether the user can restore the video policy.
     *
     * @param  \App\User  $user
     * @param  \App\VideoPolicy  $videoPolicy
     * @return mixed
     */
    public function restore()
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the video policy.
     *
     * @param  \App\User  $user
     * @param  \App\VideoPolicy  $videoPolicy
     * @return mixed
     */
    public function forceDelete()
    {
        //
    }
}
