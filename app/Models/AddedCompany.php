<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AddedCompany
 * @package App\Models
 *
 * @mixin \Eloquent
 *
 */
class AddedCompany extends Model
{
    protected $table = 'added_company';

	public function name(){
		return $this->{'name_'.\App::getLocale()};
	}

}
