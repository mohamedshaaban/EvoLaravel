<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UsersRating extends Model
{
    public  $table= 'users_ratings';
    protected $fillable = [
        'user_id', 'host_id', 'rating'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function host(){
        return $this->belongsTo(User::class,'host_id');
    }
}
