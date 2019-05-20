<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ReportEvent extends Model
{
    public  $table= 'report_event';
    protected $fillable = [
        'reporter_id', 'event_id', 'problem'
    ];

    public function reporter(){
        return $this->belongsTo(User::class,'reporter_id');
    }
    public function event(){
        return $this->belongsTo(Event::class,'event_id');
    }
}
