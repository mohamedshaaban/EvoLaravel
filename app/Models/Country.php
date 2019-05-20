<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Currency;

class Country extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'name_en', 'name_ar', 'code','status'
    ];

    public function name()
    {
        return $this->{'name_' . \App::getLocale()};
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }
    public function customers()
    {
        return $this->belongsToMany(customers::class);
    }

    public function currency()
    {
        return $this->hasOne(Currency::class);
    }
}
