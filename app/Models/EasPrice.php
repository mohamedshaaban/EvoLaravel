<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BalanceTransaction;
use App\Models\Currency;

class EasPrice extends Model
{
    protected $table = 'eas_price';
    protected $fillable = [
        'name_en', 'name_ar', 'price', 'num_of_events', 'num_of_activity', 'num_of_services'
    ];

    public function packagesTransaction()
    {
        return $this->hasMany(BalanceTransaction::class, 'user_id');
    }

    public function getPriceAttribute($price)
    {
        $currency_value = Currency::where('code', session()->get('currency'))->first();
        return round($price * $currency_value->value,2);
    }

}
