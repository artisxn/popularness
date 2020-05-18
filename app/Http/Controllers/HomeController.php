<?php

namespace App\Http\Controllers;


use App\Package;
use App\User;
use App\Video;
use App\VideoPolicy;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Genre;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class HomeController extends Controller
{

    public function index()
    {

        $userId = (int)Auth::user()->id;
        $userInfo = User::find($userId);
        // create project after login if project was not created for artist user
        if ($userInfo->project_id == NULL && $userInfo->user_type == 2) {
            // project will create only for artist
            // when a fan change to artist, we will logout forcefully
            // after login with artist project will create only for first time
            $projectName = env('APP_ENV') . uniqid('-', $userInfo->id);

            $client = new Client(['base_uri' => env('WISTIA_API_URL')]);
            $response = $client->request('POST', 'projects.json', [
                'auth' => ['api', env('WISTIA_API_KEY')],
                'form_params' => [
                    'name' => $projectName,
                    'adminEmail' => env('WISTIA_ADMIN_EMAIL'),
                    'anonymousCanUpload' => 0,
                    'anonymousCanDownload' => 0,
                    'public' => 1
                ]
            ]);

            //Get response from API call
            $return_result = json_decode($response->getBody(), true);
            if (is_array($return_result)) {
                // project update into users table
                User::where(['id' => $userId])
                    ->update(['project_id' => $return_result['hashedId']]);
            }
        }
        $filePath = env('AWS_S3_URL') . env('APP_ENV') . '/user/';
        $userInfo->image = $userInfo->image == NULL ? $filePath . 'avatar.jpg' : $filePath . $userInfo->image;
        return view('client.setting', ['data' => $userInfo]);
    }

    public function homePage()
    {

        $genres = Genre::all();
        return view('main_home', ['genres' => $genres]);
    }

    public function artistPage()
    {

        // if user already login will be redirect to home page
        if (Auth::user()) {
            return redirect('/home');
        }

        $genres = Genre::all();
        $packages = Package::all();
        return view('artist_register', ['genres' => $genres, 'packages' => $packages]);
    }

    public function fanPage()
    {
        // if user already login will be redirect to home page
        if (Auth::user()) {
            return redirect('/home');
        }

        return view('fan_register');
    }

    public function getVideoContent(Request $request)
    {
        $video_status = 1;

        $request_data = $request->all();

        if (isset($request_data['artists'])) {
            $artists = explode(',', $request_data['artists']);
            $artists_like = "";
            $count = 0;
            foreach ($artists as $artist_anme) {
                if ($count == 0) {
                    $artists_like .= "artistname LIKE '$artist_anme%'";
                } else {
                    $artists_like .= " OR artistname LIKE '$artist_anme%'";
                }
                $count++;
            }
        }

        $defaultRawSelect = "videos.id,videos.views,videos.title,videos.image,videos.status,videos.artistname,videos.hash_id,genres.genre as genres_name,DATE_FORMAT(videos.created_at,'%M %d,%Y') as created_date";

        if (isset($request_data['genres']) && isset($request_data['date']) && isset($request_data['artists'])) {
            $date = $request_data['date'];
            $genres_arr = explode(',', $request_data['genres']);
            $videos = Video::select(DB::raw($defaultRawSelect))
                ->whereDate('videos.created_at', $date)
                ->where('videos.status', $video_status)
                ->whereIn('genres', $genres_arr)
                ->whereRaw($artists_like)
                ->join('genres', 'genres.id', '=', 'videos.genres')
                ->latest('videos.created_at')
                ->take(15)
                ->get();

        } else if (isset($request_data['genres']) && isset($request_data['date'])) {
            $date = $request_data['date'];
            $genres_arr = explode(',', $request_data['genres']);

            $videos = Video::select(DB::raw($defaultRawSelect))
                ->whereDate('videos.created_at', $date)
                ->where('videos.status', $video_status)
                ->whereIn('genres', $genres_arr)
                ->join('genres', 'genres.id', '=', 'videos.genres')
                ->latest('videos.created_at')
                ->take(15)
                ->get();
        } else if (isset($request_data['genres']) && isset($request_data['artists'])) {
            $genres_arr = explode(',', $request_data['genres']);
            $videos = Video::select(DB::raw($defaultRawSelect))
                ->whereRaw($artists_like)
                ->where('videos.status', $video_status)
                ->whereIn('genres', $genres_arr)
                ->join('genres', 'genres.id', '=', 'videos.genres')
                ->latest('videos.created_at')
                ->take(15)
                ->get();
        } else if (isset($request_data['date']) && isset($request_data['artists'])) {
            $date = $request_data['date'];
            $videos = Video::select(DB::raw($defaultRawSelect))
                ->whereRaw($artists_like)
                ->where('videos.status', $video_status)
                ->whereDate('videos.created_at', $date)
                ->join('genres', 'genres.id', '=', 'videos.genres')
                ->latest('videos.created_at')
                ->take(15)
                ->get();
        } else if (isset($request_data['genres'])) {
            $genres_arr = explode(',', $request_data['genres']);
            $videos = Video::select(DB::raw($defaultRawSelect))
                ->whereIn('genres', $genres_arr)
                ->where('videos.status', $video_status)
                ->join('genres', 'genres.id', '=', 'videos.genres')
                ->latest('videos.created_at')
                ->take(15)
                ->get();
        } else if (isset($request_data['date'])) {
            $date = $request_data['date'];
            $videos = Video::select(DB::raw($defaultRawSelect))
                ->whereDate('videos.created_at', $date)
                ->where('videos.status', $video_status)
                ->join('genres', 'genres.id', '=', 'videos.genres')
                ->latest('videos.created_at')
                ->take(15)
                ->get();
        } else if (isset($request_data['artists'])) {
            $videos = Video::select(DB::raw($defaultRawSelect))
                ->whereRaw($artists_like)
                ->where('videos.status', $video_status)
                ->join('genres', 'genres.id', '=', 'videos.genres')
                ->latest('videos.created_at')
                ->take(15)
                ->get();
        } else {
            $videos = Video::select(DB::raw($defaultRawSelect))
                ->where('videos.status', $video_status)
                ->join('genres', 'genres.id', '=', 'videos.genres')
                ->latest('videos.created_at')
                ->take(15)
                ->get();
        }

        $videos_data = collect($videos)->groupBy('created_date');
        return view('video.content', ['contents' => $videos_data]);
    }

    public function watch($hashId)
    {
        // Get the currently authenticated user's ID...
        $userId = Auth::id();

        if ($userId === NULL) {
            $video = Video::where('videos.hash_id', $hashId)
                ->select('videos.genres','videos.user_id' ,'videos.id', 'videos.status  as video_status')
                ->first();
            $videoFavouriteStatus = 'color:black';
        } else {
            $video = Video::where('videos.hash_id', $hashId)
                ->leftJoin('user_video_favourites', function ($join) use ($userId) {
                    $join->on('user_video_favourites.video_id', '=', 'videos.id')
                        ->where('user_video_favourites.user_id', $userId);
                })
                ->select('videos.status as video_status','videos.user_id', 'videos.genres', 'videos.id', 'user_video_favourites.status')
                ->first();
            $videoFavouriteStatus = isset($video->status) && $video->status == 1 ? 'color:red' : 'color:black';
        }

        if (empty($video)) {
            return Redirect::route('home-page');
        }
        $videoUserId = $video->user_id;

        // if video is un-published then should be back in previous page
        if ((int)$video->video_status === 2) {
            return redirect()->back();
        }

        $videoId = $video->id;

        // if data found based on iframe id

        $genres_arr = explode(',', $video->genres);

        $videos = Video::select(DB::raw("videos.views,genres.genre as genre_name,videos.title,videos.id,videos.image,videos.status,videos.artistname,videos.hash_id,DATE_FORMAT(videos.created_at,'%M %d,%Y') as created_date"))
            ->whereIn('genres', $genres_arr)
            ->join('genres', 'genres.id', '=', 'videos.genres')
            ->orderBy('videos.views', 'desc')
            ->take(5)
            ->get();

        $videoPolicy = VideoPolicy::first();

        return view('video.watch', ['videoPolicy'=>$videoPolicy,'favouriteStatus' => $videoFavouriteStatus, 'videoId' => $videoId,'videoUserId'=>$videoUserId, 'videoIframe' => $hashId, 'contents' => $videos]);
    }
}