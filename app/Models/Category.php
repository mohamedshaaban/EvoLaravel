<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    public function parent(){
    	return $this->belongsTo( self::class, 'category_id', 'id');
    }

    public function name(){
    	return $this->{'name_'.\App::getLocale()};
    }
}
