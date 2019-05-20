<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Badges extends Model {

	const TARGET_GENDER_ALL = 0;
	const TARGET_GENDER_MALE = 1;
	const TARGET_GENDER_FEMALE = 2;

	const BADGE_TYPE_TRANSACTIONS = 1;
	const BADGE_TYPE_EAS = 2;


	protected $fillable = [
		'id',
		'code',
		'name_en',
		'name_ar',
		'logo',
		'user_type',
		'target_gender',
		'badge_type',
		'no_of_transactions_from',
		'no_of_transactions_to',
		'no_eas_from',
		'no_eas_to',
		'include_rating',
		'rating_from',
		'rating_to'
	];

	public function user() {

		return $this->belongsToMany( User::class, 'user_badges', 'user_id', 'badge_id' );

	}
}
