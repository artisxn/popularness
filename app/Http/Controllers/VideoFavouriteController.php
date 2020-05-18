<?php

namespace App\Http\Controllers;

use App\UserVideoFavourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class VideoFavouriteController extends Controller
{
    public function favouriteVideo()
    {
        return view('client.favourite_video');
    }

    public function myFavouriteVideos()
    {
        return response()->json($this->_myFavouriteVideos());
    }

    private function _myFavouriteVideos()
    {
        $user_id = auth()->user()->id;

        $videos = UserVideoFavourite::where([
            'user_video_favourites.user_id' => $user_id, 'user_video_favourites.status' => 1
        ])
            ->select(DB::raw("user_video_favourites.id as favouriteId,videos.*,genres.genre as genres_name,DATE_FORMAT(videos.created_at,'%M %d,%Y') as created_date"))
            ->join('videos', 'videos.id', '=', 'user_video_favourites.video_id')
            ->join('genres', 'genres.id', '=', 'videos.genres')
            ->get();

        return collect($videos)->groupBy('created_date')->toArray();
    }

    public function removeVideoFromFavouriteList(Request $request)
    {
        $id = $request->all()['id'];

        $favourite = UserVideoFavourite::find($id);
        $favourite->status = 0;
        $favourite->save();

        return response()->json($this->_myFavouriteVideos());
    }

    public function VideoFavourite(Request $request)
    {
        // Get the currently authenticated user's ID...
        $user_id = Auth::id();
        $data = $request->all();
        $videoId = $data['videoId'];

        $userVideoFavourite = UserVideoFavourite::where([
            'user_id' => $user_id,
            'video_id' => $videoId,
        ])->first();

        if (isset($userVideoFavourite->id)) {
            $status = $userVideoFavourite->status == 1 ? 0 : 1;
        } else {
            $userVideoFavourite = new UserVideoFavourite;
            $status = 1;
        }

        $userVideoFavourite->user_id = $user_id;
        $userVideoFavourite->video_id = $videoId;
        $userVideoFavourite->status = $status;
        $userVideoFavourite->save();

        return response()->json([
            'status' => 'success',
            'favourite_status' => $status,
            'message' => 'successfully operation done'
        ]);
    }
}
