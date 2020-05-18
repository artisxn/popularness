<?php

namespace App\Observers;

use App\Mail\PlayListCreate;
use App\Mail\PlayListDeleted;
use App\UserPlayList;
use App\VideoPlayList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PlayListObserver
{
    /**
     * Handle the user play list "created" event.
     *
     * @param  \App\UserPlayList  $userPlayList
     * @return void
     */
    public function created(UserPlayList $userPlayList)
    {
        $users = Auth::user();
        Mail::to($users)->send(new PlayListCreate($userPlayList));
    }

    /**
     * Handle the user play list "updated" event.
     *
     * @param  \App\UserPlayList  $userPlayList
     * @return void
     */
    public function updated(UserPlayList $userPlayList)
    {
        //
    }

    /**
     * Handle the user play list "deleted" event.
     *
     * @param  \App\UserPlayList  $userPlayList
     * @return void
     */
    public function deleted(UserPlayList $userPlayList)
    {
        // all dependency deleted
        VideoPlayList::where(['play_list_id'=> $userPlayList->id])->delete();

        // sending mail on trigger on deleted
        $users = Auth::user();
        Mail::to($users)->send(new PlayListDeleted($userPlayList));

    }

    /**
     * Handle the user play list "restored" event.
     *
     * @param  \App\UserPlayList  $userPlayList
     * @return void
     */
    public function restored(UserPlayList $userPlayList)
    {
        //
    }

    /**
     * Handle the user play list "force deleted" event.
     *
     * @param  \App\UserPlayList  $userPlayList
     * @return void
     */
    public function forceDeleted(UserPlayList $userPlayList)
    {
        //
    }
}
