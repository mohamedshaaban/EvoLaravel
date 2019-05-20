<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserReports extends Model
{
    public  $table= 'user_reports';
    protected $fillable = [
        'reporter_id', 'reported_id', 'problem' ,'title'
    ];

    public function reporter(){
        return $this->belongsTo(User::class,'reporter_id');
    }
    public function reported(){
        return $this->belongsTo(User::class,'reported_id');
    }
}
