<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class HostsUsers extends Model
{
    protected $fillable = [
        'id', 'user_id', 'company_name',
        'email', 'website', 'starting_year',
        'company_certificate', 'landline',
        'mobile', 'whatsapp', 'work_from',
        'work_to', 'break_from', 'break_to',

    ];
    public function events()
    {
        return $this->hasMany(Event::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCompanyCertificateAttribute($file)
    {
        return Request()->getSchemeAndHttpHost() . '/uploads/' . $file;
    }
}
