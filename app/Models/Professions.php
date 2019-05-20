<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Professions extends Model
{
    protected $fillable = [
        'id', 'ar_name', 'en_name', 'is_active'
    ];


    public function user()
    {
        return $this->belongsToMany(User::class, 'user_professions', 'user_id','profession_id');

    }

}
