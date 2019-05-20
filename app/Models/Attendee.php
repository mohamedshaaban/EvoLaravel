<?php

namespace App\Models;

use Encore\Admin\Grid\Filter\Group;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Attendee
 * @package App\Models
 *
 * @mixin \Eloquent
 */
class Attendee extends Model
{
	const STATUS_NOT_SET=0;
	const STATUS_ABSENT=1;
	const STATUS_ATTENDED=2;

	public function ticketType() {
		return $this->belongsTo(EventMultiplePrice::class, 'ticket_type');
	}

	public function event() {
		return $this->belongsTo(Event::class, 'event_id');
	}


}