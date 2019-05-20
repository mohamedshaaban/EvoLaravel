<?php

namespace App\Models;

use App\User;

use Illuminate\Database\Eloquent\Model;

class UserCertificateProfession extends Model
{
    protected $fillable = [
        'user_id', 'certificate_file', 'from', 'to', 'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCertificateFileAttribute($file)
    {
        return Request()->getSchemeAndHttpHost() . '/uploads/' . $file;
    }
    
}
