<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddresses extends Model
{
    protected $fillable =[
        'country_id' , 'address' ,'street','state','building_number','floor_number'
    ];


}
