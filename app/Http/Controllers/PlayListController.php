<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\UserPlayList;
use App\VideoPlayList;
use Illuminate\Support\Str;


class PlayListController extends Controller
{

    public function myPlayList()
    {
        return view('client.play_list');

    }

    public function myPlayListData()
    {

        $user_id = Auth::user()->id;
        $playList = UserPlayList::where(['user_id' => $user_id])->get();

        return response()->json($playList);

    }

    public function VideoPlayList(Request $request)
    {
        $user_id = auth()->user()->id;
        $data = $request->all();
        $videoId = $data['videoId'];


        $usersPlayLists = UserPlayList::select("user_play_lists.name", "user_play_lists.id", "video_playlists.status",
            DB::raw("IF(video_playlists.video_id = $videoId,true,false) check_status"))
            ->leftJoin('video_playlists', function ($join) use ($videoId) {
                $join->on('video_playlists.play_list_id', '=', 'user_play_lists.id')
                    ->where('video_playlists.video_id', $videoId);

            })
            ->where(['user_play_lists.user_id' => $user_id])
            ->groupBy('user_play_lists.id')
            ->orderBy('user_play_lists.id', 'DESC')
            ->get()->toArray();


        return response()->json($usersPlayLists);
    }

    public function CreatePlayList(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->all();

        $videoId = $data['videoId'];
        $playListName = $data['playListName'];

        DB::beginTransaction();
        // Play List Create
        $playList = UserPlayList::create([
            'user_id' => $user_id,
            'name' => $playListName,
            'status' => 1,
            'hash_id' => Str::random(13),

        ]);

        if (!$playList) {
            DB::rollback();
        }

        // Video Play List Create
        $videoPlayList = VideoPlayList::create([
            'play_list_id' => $playList->id,
            'video_id' => $videoId,
            'status' => 1,
        ]);
        if (!$videoPlayList) {
            DB::rollback();
        }
        DB::commit();
        return response()->json(['status' => 'success', 'message' => 'Play List create successfully done.']);

    }

    public function playListUpdate(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->all();

        if (!isset($data['playListName'])) {
            return response()->json(['status' => 'error', 'message' => 'PlayList field is required!']);
        }

        $id = $data['id'];
        $playListName = $data['playListName'];

        UserPlayList::where(['id' => $id, 'user_id' => $user_id])->update(['name' => $playListName]);

        return response()->json(['status' => 'success', 'message' => 'successfully updated']);

    }

    public function viewPlayList($hashId)
    {

        $userId = Auth::user()->id;

        $check = UserPlayList::where(['hash_id' => $hashId, 'user_id' => $userId])->count();

        if ($check == 0) {
            return Redirect::route('my-play-video');
        }

        return view('client.play_list_video', ['hash_id' => $hashId]);
    }

    public function playListVideo($hashId)
    {

        $userId = Auth::user()->id;
        $check = UserPlayList::where(['hash_id' => $hashId, 'user_id' => $userId])->first();
        $playListPk = $check->id;

        $videos_data = $this->_playListIdWiseVideo($playListPk);

        return response()->json($videos_data);
    }

    public function playListDlt($id)
    {
        UserPlayList::find($id)->delete();
        return Redirect::route('my-play-video');
    }

    public function playListDelete(Request $request)
    {

        $id = $request->all()['id'];
        UserPlayList::find($id)->delete();
        $userId = Auth::user()->id;

        $playList = UserPlayList::where(['user_id' => $userId])->get();

        return response()->json($playList);
    }

    public function removeVideoFromPlayList(Request $request)
    {
        $id = $request->all()['id'];
        $playListPk = $request->all()['playListId'];

        VideoPlayList::find($id)->delete();

        $videos_data = $this->_playListIdWiseVideo($playListPk);
        return response()->json($videos_data);
    }

    private function _playListIdWiseVideo($playListPk)
    {

        $videos = VideoPlayList::where(['video_playlists.play_list_id' => $playListPk])
            ->select(DB::raw("$playListPk as playListId,videos.*,video_playlists.id as video_play_list_pk,genres.genre as genres_name,DATE_FORMAT(videos.created_at,'%M %d,%Y') as created_date"))
            ->join('videos', 'videos.id', '=', 'video_playlists.video_id')
            ->join('genres', 'genres.id', '=', 'videos.genres')
            ->get();

        return collect($videos)->groupBy('created_date')->toArray();

    }
}
