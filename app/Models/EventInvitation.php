<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Media;

class EventInvitation extends Model
{
    protected  $table='event_invitation';
    public function event(){
        return $this->belongsTo(Event::class, 'event_id');
    }
}
