<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendNotification extends Model
{
    protected $fillable = ['notification_type', 'user_type', 'subject', 'message', 'description', 'status'];


    const TYPE_EMAIL = 1;
    const TYPE_MOBILE = 2;
    const TYPE_BOTH = 3;


}

