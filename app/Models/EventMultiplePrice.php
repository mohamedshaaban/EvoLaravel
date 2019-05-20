<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Media;
use App\Models\BookingDetail;
use App\Models\Currency;

class EventMultiplePrice extends Model
{

	protected $table = 'event_multiple_price';

	public function name()
	{
		return $this->{'name_' . \App::getLocale()};
	}

	public function groupPrice()
	{
		return $this->hasMany(EventGroupPrice::class, 'price_type_id', 'id');
	}

	public function getTotalPrice($ticketNo)
	{

		$prices = $this->groupPrice()->orderByDesc('ticket_no')->get();
		$amount = 0;

		for ($i = 0; $i < count($prices); $i++) {
			if ($prices[$i]->ticket_no <= $ticketNo) {
				$w = intval($ticketNo / ($prices[$i]->ticket_no?:1));

				$amount += $w * $prices[$i]->price;
				$ticketNo -= $w * $prices[$i]->ticket_no;
			}
		}



		$amount += $ticketNo * $this->cost;

		return $amount;
	}

	public function getCostAttribute($cost)
	{
		$currency_value = Currency::where('code', session()->get('currency'))->first();
		return round($cost * $currency_value->value,2);
	}

	public function bookingDetail()
	{
		return $this->hasMany(BookingDetail::class);
	}
}
