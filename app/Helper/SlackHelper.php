<?php
namespace App\Helper;

use App\Notifications\ErrorNotification;
use App\User;
use Notification;

class SlackHelper
{

    public static function send($message = "Hello World!"){

        $slackObject = new User();
        $slackObject->message = $message;
        Notification::send($slackObject, new ErrorNotification());

    }

}