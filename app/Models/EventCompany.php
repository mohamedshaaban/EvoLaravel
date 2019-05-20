<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Media;

class EventCompany extends Model {

	const CONNECTION_USERS_TABLE = 1;
	const CONNECTION_ADDED_TABLE = 2;

	protected $table = 'event_company';

}
