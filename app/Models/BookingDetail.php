<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\EventMultiplePrice;

class BookingDetail extends Model
{

	public function groupPrice()
	{
		return $this->belongsTo(EventMultiplePrice::class, 'multiple_price_id');
	}


	public function getTotalPriceAttribute($total_price)
	{
		$currency_value = Currency::where('code', session()->get('currency'))->first();
		return round($total_price * $currency_value->value, 2);
	}


}
