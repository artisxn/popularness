<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Middleware\CheckPayment;

Route::get('/', 'HomeController@homePage')->name('home-page');
Route::get('/artistRegister', 'HomeController@artistPage');
Route::get('/fanRegister', 'HomeController@fanPage');


Route::prefix('page')->group(function () {

    //LEGAL / TOOLS
    Route::view('terms', 'page.terms');
    Route::view('policy', 'page.policy');
    Route::view('site_map', 'page.site_map');
    Route::view('partnership', 'page.partnership');

    //MEDIA
    Route::view('news', 'page.news');
    Route::view('press_kit', 'page.press_kit');
    Route::view('media_inquiries', 'page.media_inquiries');
    Route::view('imagery', 'page.imagery');

    //SERVICES
    Route::view('packages', 'page.packages');
    Route::view('video_analysis', 'page.video_analysis');
    Route::view('royalties', 'page.royalties');
    Route::view('imagery', 'page.imagery');

    //CORPORATE
    Route::view('company_profile', 'page.company_profile');
    Route::view('advertising', 'page.advertising');
    Route::view('career', 'page.career');
    Route::view('faq', 'page.faq');
    Route::view('contact', 'page.contact');

});

//Global Function
Route::get('/getVideo', 'HomeController@getVideoContent');
Route::get('/watch/{id}', 'HomeController@watch');
Route::get('/getVideoTransactions/{videoId}', 'TransactionController@getVideoTransactions');


Route::get('mailable', function () {
    $invoice = App\User::find(1);
    return new App\Mail\UserStatusChanged($invoice);
});


Auth::routes(['verify' => true]);
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

// Socialite Integration
Route::get('/login/{social}', 'Auth\LoginController@socialLogin')->where('social',
    'twitter|facebook|linkedin|google|github');
Route::get('/callback/{social}', 'Auth\LoginController@handleProviderCallback')->where('social',
    'twitter|facebook|linkedin|google|github');


Route::middleware(['auth', 'verified'])->group(function () {

    //HomeController
    Route::get('/home', 'HomeController@index')->name('client-home');

    //UserController
    Route::post('/user/update', 'UserController@update');

    // TransactionController

    Route::get('/balance', 'TransactionController@balance')->name('my-balance');
    Route::get('/myBalance', 'TransactionController@myBalance')->name('get-my-balance');
    Route::post('/videoContribution', 'TransactionController@videoContribution');

    //SubscriptionController
    Route::get('/subscription', 'SubscriptionController@index')->name('my-subscription');
    Route::get('/CngSubcrp', 'SubscriptionController@changeSubscription')->name('change-subscription');
    Route::get('/CngPackage', 'SubscriptionController@changePackage')->name('change-package');


    //VideoController
    Route::group(['middleware' => [CheckPayment::class]], function () {

        // GET Call
        Route::get('/videos', 'VideoController@myVideo')->name('client-video');
        Route::get('/myVideos', 'VideoController@myVideos')->name('my-videos');
        Route::get('/upload', 'VideoController@upload')->name('video-upload');
        Route::get('VideoStates/{hash_id}', 'VideoController@VideoStates')->name('video-states');
        Route::get('/video/{iframe}/{id}', 'VideoController@viewVideo')->name('video-update');
        Route::get('/transactions/{iframe}/{id}', 'VideoController@viewTransaction')->name('video-transaction');

        // POST Call
        Route::post('videoDataSave', 'VideoController@uploadVideo')->name('upload');
        Route::post('/mediaStatusUpdate', 'VideoController@mediaStatusUpdate')->name('status-update');
        Route::post('/updateVideo', 'VideoController@updateVideoInfo')->name('video-info-update');
        Route::post('/mediaDelete', 'VideoController@mediaDelete');
        Route::post('videoLimitCheck', 'VideoController@videoLimitCheck')->name('video-limit-check');
    });


    //PlayListController
    Route::get('/playList', 'PlayListController@myPlayList')->name('my-play-video');
    Route::get('/myPlayListData', 'PlayListController@myPlayListData')->name('my-play-list-data');
    Route::post('VideoPlayList', 'PlayListController@VideoPlayList')->name('video-play-list');
    Route::post('CreatePlayList', 'PlayListController@CreatePlayList')->name('create-play-list');
    Route::post('playListUpdate', 'PlayListController@playListUpdate')->name('update-play-list');

    Route::get('/viewPlayList/{id}', 'PlayListController@viewPlayList')->name('view-play-List');
    Route::post('/playListVideo/{hash_id}', 'PlayListController@playListVideo')->name('play-List-video');
    Route::post('/playListDelete', 'PlayListController@playListDelete');
    Route::post('/removeVideoFromPlayList',
        'PlayListController@removeVideoFromPlayList')->name('remove-video-play-list');


    //VideoPlayListController
    Route::post('UpdateVideoPlayList', 'VideoPlayListController@UpdateVideoPlayList')->name('update-play-list');


    //VideoFavouriteController
    Route::get('/favourite', 'VideoFavouriteController@favouriteVideo')->name('my-favourite-video');
    Route::get('/myFavouriteVideos', 'VideoFavouriteController@myFavouriteVideos')->name('my-favourite-video-list');
    Route::post('/removeVideoFromFavouriteList',
        'VideoFavouriteController@removeVideoFromFavouriteList')->name('remove-video-favourite-list');
    Route::post('VideoFavourite', 'VideoFavouriteController@VideoFavourite')->name('video-favourite-list');

    //StripePaymentController
    Route::get('/payment', 'StripePaymentController@stripe')->name('stripe-payment');
    Route::post('/stripe', 'StripePaymentController@stripePost')->name('stripe.post');
    Route::post('/depositWallet', 'StripePaymentController@depositWallet');

});





