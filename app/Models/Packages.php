<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\BalanceTransaction;
use App\Models\Currency;

class Packages extends Model
{
    protected $fillable = [
        'name_en', 'name_ar', 'price', 'num_of_events', 'num_of_activity', 'num_of_services'
    ];


    public function user()
    {
        return $this->belongsToMany(
            User::class,
            'user_packages',
            'package_id',
            'user_id'
        );
    }

    public function PackagesTransaction()
    {
        return $this->hasMany(BalanceTransaction::class, 'user_package_id');
    }

    public function getPriceAttribute($price)
    {
        $currency_value = Currency::where('code', session()->get('currency'))->first();
        return round($price * $currency_value->value, 2);
    }

}
