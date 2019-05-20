<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $fillable = [
        'name', 'title_ar', 'title_en', 'content_ar', 'content_en', 'slug', 'status'
    ];
}
