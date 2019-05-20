<?php

namespace App;

use App\Models\Badges;
use App\Models\customers;
use App\Models\Event;
use App\Models\EventReviews;
use App\Models\EventsUsers;
use App\Models\UserContacts;
use App\Models\UserFavoriteHosts;
use App\Models\UserMedia;
use App\Models\UsersRating;
use App\Models\UserTermsPrivacy;
use http\Env\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Professions;
use App\Models\UserSocialMedia;
use App\Models\HostsUsers;
use App\Models\UserCertificateProfession;
use App\Models\Packages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\BalanceTransaction;
use App\Models\Booking;
use App\Models\UserStatus;
use App\Notifications\MailResetPasswordToken;use Laravel\Passport\HasApiTokens;


/**
 * Class User
 * @package App
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    // verified and verified users
    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    // roles users and companies
    const ALL_USER_ROLE_ID = 0;
    const HOST_USER_ROLE_ID = 1;
    const NORMAL_USER_ROLE_ID = 2;

    // types companies users
    const PROFESSIONAL_USER_TYPE_ID = 1;
    const GROUP_USER_TYPE_ID = 2;
    const COMPANY_USER_TYPE_ID = 3;

    //Notification Types
    const All_NOTIFICATION_TYPE =1 ;
    const EMAIL_NOTIFICATION_TYPE =2 ;
    const SITE_NOTIFICATION_TYPE =3 ;

    // verified and verified users
    const SUSPEND_USER = '0';
    const APPROVED_USER = '1';
    const REJECTED_USER = '2';    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verified',
        'verification_token', 'avatar', 'role_id', 'type', 'country_id'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAvatarAttribute($image)
    {
        return Request()->getSchemeAndHttpHost() . '/uploads/' . $image;
    }

    public static function generateVerificationCode()
    {
        return str_random(40);
    }

    public function profession()
    {
        return $this->belongsToMany(Professions::class, 'user_professions', 'user_id', 'profession_id');
    }
    public function badges()
    {
        return $this->belongsToMany(Badges::class, 'user_badges', 'user_id', 'badge_id');
    }
    public function FavoriteHosts()
    {
        return $this->hasMany(UserFavoriteHosts::class);
    }
    public function socailMedia()
    {
        return $this->hasMany(UserSocialMedia::class);
    }

    public function host()
    {
        return $this->hasOne(HostsUsers::class);
    }

    public function userCertificate()
    {
        return $this->hasMany(UserCertificateProfession::class);
    }

    public function customers()
    {
        return $this->hasOne(customers::class);
    }
    public function UserContacts()
    {
        return $this->hasMany(UserContacts::class);
    }
    public function EventsUsers()
    {
        return $this->hasMany(EventsUsers::class);
    }
    public function event()
    {
        return $this->belongsToMany(Event::class, 'events_users', 'user_id', 'event_id');
    }
    public function EventReviews()
    {
        return $this->hasMany(EventReviews::class);
    }

    public function packeges()
    {
        return $this->belongsToMany(Packages::class, 'user_packages', 'user_id', 'package_id');
    }
    public function UsersRatingNegative()
    {
        return $this->hasMany(UsersRating::class)->where('rating', 3);
    }

    public function ratingpositive($user_id)
    {
        return (UsersRating::where('rating', 1)->where('host_id', $user_id)->count());
    }
    public function ratingneutral($user_id)
    {
        return (UsersRating::where('rating', 2)->where('host_id', $user_id)->count());
    }

    public function ratingnegative($user_id)
    {
        return (UsersRating::where('rating', 3)->where('host_id', $user_id)->count());

    }
    public function UserMedia()
    {
        return $this->hasMany(UserMedia::class);
    }
    public function UserTermsPrivacy()
    {
        return $this->hasOne(UserTermsPrivacy::class);
    }

    public function packagesTransaction()
    {
        return $this->hasMany(BalanceTransaction::class, 'user_id');
    }

    public function booking() {
		return $this->hasMany(Booking::class);
	}
    public function userstatus() {
        return $this->hasMany(UserStatus::class);
    }

}
