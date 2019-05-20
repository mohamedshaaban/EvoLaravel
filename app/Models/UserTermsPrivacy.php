<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserTermsPrivacy extends Model
{
    public  $table= 'users_terms_privacy';
    public $timestamps=false;
    const PRIVACY_POLICY = 1;
    const TERMS_CONDITIONS =2 ;
    protected $fillable = [
        'user_id', 'content', 'type'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
