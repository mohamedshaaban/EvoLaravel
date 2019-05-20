<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfessions extends Model
{
    protected $fillable = [
        'user_id' ,'profession_id' ,'name' ,'from' ,'to' ,'certificate_file' 
    ];
    

}
