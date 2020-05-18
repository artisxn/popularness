<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Chaseconey\ExternalImage\ExternalImage;
use Laravel\Nova\Panel;
use Metrixinfo\Nova\Fields\Iframe;
use Laravel\Nova\Fields\Select;
class   Video extends Resource
{

//    public static $group = 'Admin';


    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Video';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static $with = ['user'];


    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Text::make('Title','title')->sortable(),
            BelongsTo::make('User','user')->onlyOnIndex(),
            ExternalImage::make('Thumbnail','wistia')->resolveUsing(function($wistia){
                $data = json_decode($wistia,true);
                return $data['thumbnail']['url'];

            })->onlyOnIndex(),
            Select::make('status')->options([
                0 => 'Un-published',
                1 => 'Published',
                2 => 'Banned',
            ])->displayUsingLabels()->sortable(),

            Iframe::make('Video','wistia')->resolveUsing(function($wistia){
                $video_content = json_decode($wistia,true);
                $videHashId =$video_content['id'];
                return "<iframe src=\"//fast.wistia.net/embed/iframe/$videHashId\"
                                allowtransparency=\"true\" frameborder=\"0\" scrolling=\"no\"
                                class=\"wistia_embed\" name=\"wistia_embed\"
                                allowfullscreen mozallowfullscreen webkitallowfullscreen oallowfullscreen msallowfullscreen
                                width=\"40%\"></iframe>";

            })->size('100%',180),
            new Panel('Video States',$this->videoStats()),
        ];
    }

    protected function videoStats(){

        return [
            Text::make('Average Engagement','average_engagement')->onlyOnDetail(),
            Text::make('Total Play','total_play')->onlyOnDetail(),
            Text::make('Total Visitors','visitors')->onlyOnDetail(),
            Text::make('Clicking play','clicking_play')->onlyOnDetail(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new  Filters\VideoStatus('status'),
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }


    public static function perPageOptions()
    {
        return [10,20,30,40,50];
    }
}
