<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class AddressType extends Model
{
	protected $table = 'address_type';

	public function name()
	{
		return $this->{'name_'.\App::getLocale()};
	}


	public function host()
	{
		return $this->belongsTo(HostsUsers::class, 'host_id');
	}

	public function event()
	{
		return $this->belongsTo(Event::class);
	}

}
