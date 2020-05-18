<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VideoPlayList;

class VideoPlayListController extends Controller
{

    public function UpdateVideoPlayList(Request $request)
    {
        $data = $request->all();

        $videoId = $data['videoId'];
        $playListId = $data['playListId'];

        // Retrieving Video Play List data if any
        $query = VideoPlayList::select('id')
            ->where(['play_list_id' => $playListId, 'video_id' => $videoId])
            ->first();
        if (isset($query->id)) {

            // Video  delete from play list
            VideoPlayList::where(
                ['play_list_id' => $playListId, 'video_id' => $videoId]
            )->delete();

        } else {
            $videoPlayList = new VideoPlayList;

            $videoPlayList->play_list_id = $playListId;
            $videoPlayList->video_id = $videoId;
            $videoPlayList->status = 1;

            $videoPlayList->save();
        }

        return response()->json(
            [
                'status' => 'success',
                'message' => 'Operation update successfully']
        );
    }
}
