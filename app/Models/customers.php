<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class customers extends Model
{
    protected $fillable = [
        'id','user_id', 'full_name', 'date_of_birth', 'is_active','gender','country_id','description'
    ];


    public function User()
    {
        return $this->belongsTo(User::class);

    }

    public function Country()
    {
        return $this->hasOne(Country::class,  'id','country_id'   );

    }
}
