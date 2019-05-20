<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserSocialMedia extends Model
{
    protected $fillable = [
        'user_id', 'type', 'link',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
