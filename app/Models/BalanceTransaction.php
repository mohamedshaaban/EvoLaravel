<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Packages;
use App\Models\EasPrice;

class BalanceTransaction extends Model
{
    public $table = 'balance_transaction';
    protected $fillable = [
        'user_id', 'purchase_date', 'number_of_events', 'number_of_activity', 'number_of_services', 'total', 'user_package_id', 'use_eas_id'
    ];

    // public function user(){
    //     return $this->belongsTo(User::class,'user_id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    public function package()
    {
        return $this->belongsTo(Packages::class);
    }

    public function easPrice()
    {
        return $this->belongsTo(EasPrice::class);
    }
}
