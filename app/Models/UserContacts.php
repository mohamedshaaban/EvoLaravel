<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserContacts extends Model
{
    public  $table= 'user_contacts';
    protected $fillable = [
        'user_id', 'name', 'image', 'phone'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
