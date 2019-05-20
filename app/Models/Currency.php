<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class Currency extends Model
{

    protected $fillable = [
        'name_en', 'name_ar', 'code', 'symbol', 'value', 'status', 'country_id'
    ];
    public function isActive()
    {
        return $this->status == 1;
    }

    /**
     * Get the country record associated with the currency.
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
