<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserMedia extends Model
{
    const MEDIA_FILE = 1;
    const MEDIA_IMAGE = 2;
    const MEDIA_VIDEO = 3;
    protected $fillable = [
        'user_id' ,'media', 'type'
    ];
    public function User()
    {
        return $this->belongsToMany(User::class);
    }

}
