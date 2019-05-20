<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Mail\Notifications as MailNotification;

/**
* Class Order
* @package App\Models
* @mixin \Eloquent
*/
class Notifications extends Model
{
    const NOTIFICATION_CREATED = 0 ;
    const NOTIFICATION_READED = 1 ;

    protected $fillable =
        ['user_from' , 'suer_to', 'title', 'message', 'status'];

    public function Userfrom() {
    	return $this->belongsTo(User::class, 'user_from', 'id');
    }

    public function Userto() {

        return $this->belongsTo(User::class, 'user_to', 'id');
    }
    public static function notify($data)
    {

        $user = User::where('id',$data['user_to'])->first();
        if($user->notification_type == User::All_NOTIFICATION_TYPE)
        {

            $notify = Notifications::create([
                'user_from' => $data['user_from'],
                'user_to' => $data['user_to'],
                'title' => $data['title'],
                'message' => $data['message'],
                'status' => Notifications::NOTIFICATION_CREATED,
                'route' => $data['route']
            ]);

                Mail::to($user->email)->send(new MailNotification($data));

        }
        else if($user->notification_type == User::EMAIL_NOTIFICATION_TYPE)
        {

                Mail::to($user->email)->send(new MailNotification($data));

        }
        else
        {
            $notify = Notifications::create([
                'user_from' => $data['user_from'],
                'user_to' => $data['user_to'],
                'title' => $data['title'],
                'message' => $data['message'],
                'status' => Notifications::NOTIFICATION_CREATED,
                'route' => $data['route']
            ]);
        }

        return 1;
    }
    public static function read_notification($data)
    {
        $notification = Notifications::where('id',$data['notification_id'])->first();
        $notification->status = Notifications::NOTIFICATION_READED;
        $notification->update();
        if($notification->route)
        {
            return redirect()->route($notification->route);
        }
        return 1;
    }
}

