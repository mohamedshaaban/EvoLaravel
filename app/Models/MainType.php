<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MainType
 * @package App\Models
 *
 * @mixin \Eloquent
 *
 */
class MainType extends Model
{

	const EVENT_TYPE_EVENT    = 1;
	const EVENT_TYPE_ACTIVITY = 2;
	const EVENT_TYPE_SERVICE  = 3;

    protected $table = 'main_type';

	public function name(){
		return $this->{'name_'.\App::getLocale()};
	}
}
