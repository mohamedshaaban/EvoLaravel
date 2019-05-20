<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{

	const TYPE_IMAGE = 1;
	const TYPE_VIDEO = 2;

    protected  $table='media';

    public function event()
    {
        return $this->belongsToMany(Event::class , 'event_media' ,'media_id' ,'event_id' );
    }


}
