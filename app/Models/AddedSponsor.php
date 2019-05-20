<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AddedSponsor
 * @package App\Models
 *
 * @mixin \Eloquent
 *
 */
class AddedSponsor extends Model
{
    protected $table = 'added_sponsor';

	public function name(){
		return $this->{'name_'.\App::getLocale()};
	}

}
