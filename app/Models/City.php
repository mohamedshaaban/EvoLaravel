<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class City extends Model
{
    protected $table = 'city';

	public function country(){
		return $this->belongsTo(Country::class, 'country_id');
	}

	public function name(){
		return $this->{'name_'.\App::getLocale()};
	}

	public function event()
    {
        return $this->belongsTo(Event::class );
    }
}
