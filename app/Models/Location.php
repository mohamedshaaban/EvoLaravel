<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name_en', 'name_ar', 'status'
    ];

    public function venues(){
    	return $this->hasMany(Venue::class, 'location_id', 'id');
    }
}
