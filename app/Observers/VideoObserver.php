<?php

namespace App\Observers;

use App\Mail\VideoUploaded;
use App\Mail\VideoDeleted;
use App\UserVideoFavourite;
use App\Video;
use App\VideoPlayList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VideoObserver
{
    /**
     * Handle the video "created" event.
     *
     * @param \App\Video $video
     * @return void
     */
    public function created(Video $video)
    {
        $user = Auth::user();
        Mail::to($user)->send(new VideoUploaded($video));

    }

    /**
     * Handle the video "updated" event.
     *
     * @param \App\Video $video
     * @return void
     */
    public function updated(Video $video)
    {
        //
    }

    /**
     * Handle the video "deleted" event.
     *
     * @param \App\Video $video
     * @return void
     */
    public function deleted(Video $video)
    {
        // Have to delete video from favourite and play list if any
        UserVideoFavourite::where(['video_id'=> $video->id])->delete();
        VideoPlayList::where(['video_id'=> $video->id])->delete();

        // Sending mail
        $user = Auth::user();
        Mail::to($user)->send(new VideoDeleted($video));
    }

    /**
     * Handle the video "restored" event.
     *
     * @param \App\Video $video
     * @return void
     */
    public function restored(Video $video)
    {
        //
    }

    /**
     * Handle the video "force deleted" event.
     *
     * @param \App\Video $video
     * @return void
     */
    public function forceDeleted(Video $video)
    {
        //
    }

    public function updating(Video $video)
    {

    }


    public function retrieved(Video $video)
    {

    }
}
