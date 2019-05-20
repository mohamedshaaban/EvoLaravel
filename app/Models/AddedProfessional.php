<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AddedProfessional
 * @package App\Models
 *
 * @mixin \Eloquent
 */
class AddedProfessional extends Model
{
    protected $table = 'added_professional';

	public function name(){
		return $this->{'name_'.\App::getLocale()};
	}
    public function Event() {
        return $this->belongsToMany( Event::class, 'event_professional', 'professional_id','event_id' );
    }

}
