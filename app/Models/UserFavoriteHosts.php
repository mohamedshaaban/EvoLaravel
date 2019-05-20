<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserFavoriteHosts extends Model
{
    protected $fillable = [
        'user_id', 'host_id',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_favorite_hosts','id' ,'host_id' );
    }

}
