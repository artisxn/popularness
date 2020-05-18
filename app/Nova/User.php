<?php

namespace App\Nova;

use App\Nova\Metrics\NewUsers;
use Chaseconey\ExternalImage\ExternalImage;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Image;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use NovaButton\Button;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\\User';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'first_name';

    public function subtitle()
    {
        return $this->email;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [

            Image::make('Picture',function($user){
                if($user->image == NULL){
                    return env('APP_ENV').'/user/avatar.jpg';
                }
                return env('APP_ENV').'/user/'.$user->image;
            })
                ->disk('s3')
                ->prunable(false)
                ->disableDownload()
                ->maxWidth(120)
                ->deletable(false),

            Text::make('First Name','first_name')->rules('required','max:100'),
            Text::make('Last Name','last_name')->rules('required','max:100'),
            Select::make('Type','user_type')->options([
                1 => 'FAN',
                2 => 'ARTIST',
            ])->displayUsingLabels()->hideWhenUpdating(),
            BelongsTo::make('Package','package')->hideWhenUpdating(),
            Select::make('Status','is_active')->options([
                0 => 'In-Active',
                1 => 'Active',
                2 => 'Suspend',
            ])->displayUsingLabels(),
            Boolean::make('Verify','email_verified_at')->resolveUsing(function($email_verified_at){
                if($email_verified_at == NULL){
                    return FALSE;
                }else{
                    return TRUE;
                }

            })->hideWhenUpdating(),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}')->onlyOnDetail(),
            Button::make('Cancel Account')->confirm('Are you sure?'),
                HasMany::make('Videos','videos')
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
        return [
            //new NewUsers,
        ];
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
            new Filters\UserType(),
            new Filters\UserStatus(),
            new Filters\UserEmailVerify()
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
        return [
            new Actions\inactiveUser(),
        ];
    }


    public function title()
    {
        return $this->first_name.' '.$this->last_name;
    }
}
