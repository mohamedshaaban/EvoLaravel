<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Media;

class EventRequireData extends Model {

	protected $table = 'event_require_data';

	public function requiredData(){
		return $this->belongsTo(RequireData::class, 'require_data_id', 'id');
	}

}
