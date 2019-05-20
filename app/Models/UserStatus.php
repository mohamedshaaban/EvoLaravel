<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserStatus extends Model
{
    public  $table= 'user_status';
    protected $fillable = [
        'user_id', 'description'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
