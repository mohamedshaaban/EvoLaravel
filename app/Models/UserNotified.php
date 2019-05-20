<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserNotified extends Model
{
    public  $table= 'user_notified';
    protected $fillable = [
        'user_id', 'host_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function host(){
        return $this->belongsTo(User::class,'host_id');
    }
}
