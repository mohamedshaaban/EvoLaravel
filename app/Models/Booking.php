<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Event;
use App\Models\BookingDetail;
use App\Models\Attendee;
use App\User;


class Booking extends Model
{
	const PAYMENT_TYPE_KNET = 1;
	const PAYMENT_TYPE_MASTER = 2;
	const PAYMENT_TYPE_VISA = 3;

	const STATUS_PENDING = 0;
	const STATUS_PAYIED = 1;


	protected  $table='booking';

	public function event(){
		return $this->belongsTo(Event::class);
	}

	public function details(){
		return $this->hasMany(BookingDetail::class);
	}

	public function attendees(){
		return $this->hasMany(Attendee::class);
	}

	public function user(){
		return $this->belongsTo(User::class);
	}
}
