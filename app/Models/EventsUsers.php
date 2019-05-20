<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

/**
 * Class EventsUsers
 * @package App\Models
 * @mixin \Eloquent
 */
class EventsUsers extends Model
{
    public  $table= 'events_users';
    protected $fillable = [
        'user_id', 'event_id', 'date'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function event(){
        return $this->belongsTo(Event::class, 'event_id');
    }
}
