<?php

namespace App\Observers;

use App\Video;
use GuzzleHttp\Client;

class VideoObserverNova
{
    /**
     * Handle the video "created" event.
     *
     * @param  \App\Video  $video
     * @return void
     */
    public function created(Video $video)
    {
        //
    }

    /**
     * Handle the video "updated" event.
     *
     * @param  \App\Video  $video
     * @return void
     */
    public function updated(Video $video)
    {
        //
    }

    public function updating(Video $video){
        unset($video->average_engagement,$video->total_play,$video->visitors,$video->clicking_play);

    }

    public function retrieved(Video $video){

        $videoContent = json_decode($video->wistia,true);
        $mediaHashId = $videoContent['id'];

        $client = new Client(['base_uri' => env('WISTIA_API_URL')]);

        $response = $client->request('GET', "medias/$mediaHashId/stats.json", [
            'auth' => ['api', env('WISTIA_API_KEY')],
        ]);

        $return_result = json_decode($response->getBody(), true);
        if (is_array($return_result)) {
            $video->average_engagement =$return_result['stats']['averagePercentWatched'].' %';
            $video->total_play =$return_result['stats']['plays'].' time(s)';
            $video->visitors =$return_result['stats']['visitors'];
            $video->clicking_play =$return_result['stats']['percentOfVisitorsClickingPlay'].' %';
        }
    }

    /**
     * Handle the video "deleted" event.
     *
     * @param  \App\Video  $video
     * @return void
     */
    public function deleted(Video $video)
    {
        //
    }

    /**
     * Handle the video "restored" event.
     *
     * @param  \App\Video  $video
     * @return void
     */
    public function restored(Video $video)
    {
        //
    }

    /**
     * Handle the video "force deleted" event.
     *
     * @param  \App\Video  $video
     * @return void
     */
    public function forceDeleted(Video $video)
    {
        //
    }
}
