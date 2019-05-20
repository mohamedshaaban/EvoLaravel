<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class EventReviews extends Model
{
    public  $table= 'event-reviews';
    const REVIEW_POSITIVE = 1 ;
    const REVIEW_neutral = 2 ;
    const REVIEW_NEGATIVE = 3 ;

    protected $fillable = [
        'user_id', 'event_id', 'comment'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function event(){
        return $this->belongsTo(Event::class, 'event_id');
    }
}
