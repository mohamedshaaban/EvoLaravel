<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserBadges extends Model
{
    protected $fillable = [
        'user_id' ,'badge_id'
    ];
    

}
