<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class RequireData
 * @package App\Models
 *
 * @mixin \Eloquent
 *
 */
class RequireData extends Model
{
    protected $table = 'require_data';

	public function name(){
		return $this->{'name_'.\App::getLocale()};
	}
}
