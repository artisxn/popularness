<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Package;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use App\Video;
use Carbon\Carbon;


class VideoController extends Controller
{
    public function mediaStatusUpdate(Request $request)
    {
        $user_id = Auth::user()->id;

        $data = $request->all();
        $mediaId = $request['id'];
        $status = $data['status'];

        Video::where('id', $mediaId)->update(['status' => $status]);

        return response()->json($this->_myVideosData($user_id, false));
    }

    public function viewVideo($iframe, $id)
    {
        // Get the currently authenticated user's ID...
        $user_id = Auth::id();

        $video = Video::where(['id' => $id, 'user_id' => $user_id, 'wistia->id' => $iframe])->first();
        if (empty($video)) {
            return redirect()->back();
        }

        $genres = Genre::all();
        return view('client.video-edit', ['video' => $video, 'genres' => $genres]);
    }

    public function updateVideoInfo(Request $request)
    {
        $data = $request->all();
        $hashId = $data['hash_id'];
        $ex = explode('-', $hashId);

        $userId = Auth::user()->id;

        $mediaId = $ex[1];
        Video::where(['id' => $mediaId, 'user_id' => $userId])->update([
            'title' => $data['title'],
            'artistname' => $data['artist'],
            'genres' => $data['UserPrimaryGenre'],
        ]);
        return Redirect::route('client-video');
    }

    public function mediaDelete(Request $request)
    {
        $data = $request->all();
        $mediaId = $data['id'];
        $mediaHashId = $data['hashId'];

        // video content deleting from local db
        Video::where('id', $mediaId)->delete();

        //Checking transaction for the video
        $transaction = Transaction::where(['product_id' => $mediaId])->count();

        if ($transaction == 0) { // Video will be deleting from wistia only for transaction = 0
            //.
            $client = new Client(['base_uri' => env('WISTIA_API_URL')]);

            $response = $client->request('DELETE', "medias/$mediaHashId.json", [
                'auth' => ['api', env('WISTIA_API_KEY')],
            ]);

            //$return_result = json_decode($response->getBody(), true);
            //TODO:: Have to introduce slack notification if any error message found.
        }

        $user_id = Auth::user()->id;
        return response()->json($this->_myVideosData($user_id,false));
    }

    public function myVideo()
    {
        $userType = Auth::user()->user_type;

        // user type 1 = fan user and 2 = artist user
        if ($userType == 1) {
            return redirect()->back();
        }
        return view('client.video');
    }

    public function myVideos()
    {
        $userData = Auth::user();

        $user_id = $userData->id;

        $videos_data = $this->_myVideosData($user_id, false);

        return response()->json($videos_data);
    }

    private function _myVideosData($user_id, $groupBy = true)
    {
        $videos = Video::with('earningTransactionTotal')->where('user_id', $user_id)
            ->select(DB::raw("videos.created_at,videos.id,videos.title,videos.artistname,videos.status,videos.image,videos.hash_id,genres.genre as genres_name,DATE_FORMAT(videos.created_at,'%M %d,%Y') as created_date"))
            ->join('genres', 'genres.id', '=', 'videos.genres')
            ->latest('videos.created_at')
            ->get();

        if ($groupBy) {
            return collect($videos)->groupBy('created_date');
        }
        return collect($videos);
    }

    public function uploadVideo(Request $request)
    {
        $data = $request->all();
        $userId = Auth::user()->id;

        $hashId = $data['wistia']['id'];
        $image = $data['wistia']['thumbnail']['url'];

        Video::create([
            'title' => $data['title'],
            'user_id' => $userId,
            'artistname' => $data['artist'],
            'genres' => isset($data['primary_genre']) ? $data['primary_genre'] : 1,
            'maingenres' => isset($data['primary_genre']) ? $data['primary_genre'] : 1,
            'wistia' => json_encode($data['wistia']),
            'videotype' => $data['type'],
            'hash_id' => $hashId,
            'image' => $image,
            'size' => ($data['size'] / 1000) / 1000,// bytes to MB
            'views' => 0,
            'status' => 1,
        ]);

        return response()->json(['status' => 'success', 'message' => 'successfully video inserted into local db']);
    }

    public function videoLimitCheck(Request $request)
    {
        $data = $request->all();
        $userInfo = Auth::user();
        $userId = $userInfo->id;

        $packageId = $userInfo->package_id;

        $packageInfo = Package::find($packageId);
        $monthlyUpload = (int) $packageInfo->monthly_upload;
        $packageStorage = (int) $packageInfo->total_storage;
        $mediaSize = ($data['size'] / 1000) / 1000;// byte to MB

        // First day of this month
        $startDate = new Carbon('first day of this month');
        $toDate = Carbon::now();

        // default message
        $arr = ['status' => 'success', 'message' => "everything is fine"];

        // Monthly video limit
        $videoQty = Video::where(['user_id' => $userId])
            ->whereBetween('created_at', [$startDate, $toDate])
            ->count();

        if ($monthlyUpload <= $videoQty) {
            $arr = [
                'status' => 'error',
                'message' => "you can't upload any video in this months as your already reached your limit!, check your subscription details",
                'qty' => $videoQty, 'package_limit' => $monthlyUpload
            ];
        }

        // Total Storage Limit
        $videoStorage = Video::where(['user_id' => $userId])->sum('size');
        $totalStorage = $videoStorage + $mediaSize;

        if ($totalStorage > $packageStorage) {
            $arr = [
                'status' => 'error',
                'message' => "You're trying to cross total storage along with the video!, check your subscription details",
                'total_storage' => $totalStorage, 'package_storage' => $packageStorage
            ];
        }

        return response()->json($arr);
    }

    public function VideoStates($mediaHashId)
    {
        $client = new Client(['base_uri' => env('WISTIA_API_URL')]);

        $response = $client->request('GET', "medias/$mediaHashId/stats.json", [
            'auth' => ['api', env('WISTIA_API_KEY')],
        ]);

        $return_result = json_decode($response->getBody(), true);

        if (is_array($return_result)) {
            return response()->json($return_result);
        }
        return [];
    }

    public function viewTransaction($hashId, $videoId)
    {
        // Get the currently authenticated user's ID...
        $user_id = Auth::id();

        $video = Video::where(['id' => $videoId, 'user_id' => $user_id, 'wistia->id' => $hashId])->first();
        if (empty($video)) {
            return redirect()->back();
        }

        $transaction = Transaction::where(['product_id' => $videoId, 'wallet_type' => 2])
            ->select('transactions.id', 'transactions.amount', 'transactions.created_at')
            ->groupBy('transactions.id')
            ->get();
        $transaction = collect($transaction)->groupBy('id');

        return view('client.transaction', ['videoInfo' => $video, 'transactions' => $transaction]);
    }

    public function upload()
    {
        $genresData = Genre::all();
        return view('client.upload', ['genres' => $genresData]);
    }
}
