<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Media;
use App\Models\Currency;

class EventGroupPrice extends Model
{

	protected $table = 'event_group_price';


	public function getPriceAttribute($price)
	{
		$currency_value = Currency::where('code', session()->get('currency'))->first();
        return round($price * $currency_value->value,2);
	}

}
