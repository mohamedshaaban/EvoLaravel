<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Media;
use App\Models\AddressType;
use App\Models\City;
use App\Models\Booking;
use App\Models\AddedProfessional;

/**
 * Class Event
 * @package App\Models
 * @mixin \Eloquent
 */
class Event extends Model {

	const TYPE_EVENT = 1;
	const TYPE_ACTIVITY = 2;
	const TYPE_SERVICE = 3;

	const EVENT_COLOR = '#f06292';
	const ACTIVITY_COLOR = '#ba68c8';
	const SERVICE_COLOR = '#64b5f6';

	const GENDER_MALE = 1;
	const GENDER_FEMALE = 2;
	const GENDER_BOTH = 3;

	const SEATING_BOOKING_TYPE_ASSIGNED = 1;
	const SEATING_BOOKING_TYPE_RANDOM = 2;

	protected $table = 'event';

	public function title() {
		return $this->{'title_'.\App::getLocale()};
	}

	public function EventsUsers() {
		return $this->hasMany( EventsUsers::class );
	}
    public function EventInvitation() {
        return $this->hasMany( EventInvitation::class );
    }
	public function maintype() {
		return $this->belongsTo( MainType::class, 'main_type_id' );
	}

	public function category() {
		return $this->belongsTo( Category::class, 'category_id' );
	}

	public function media() {
		return $this->belongsToMany( Media::class );
	}

	public function main_media() {
		if ( $this->media ) {
			foreach ( $this->media as $row ) {
				if ( $row->caption == 'main' ) {
					return $row;
				}
			}
		}

		return new self;
	}

	public function host() {
		return $this->belongsTo( HostsUsers::class, 'host_id' , 'user_id');
	}

	public function professional() {
		return $this->belongsToMany( User::class, 'event_professional', 'event_id','professional_id' )->where('connection',1);
	}

	public function company() {
		return $this->belongsToMany( User::class, 'event_company', 'event_id', 'company_id' )->where('connection',1);
	}

	public function sponsor() {
		return $this->belongsToMany( User::class, 'event_sponsor',  'event_id', 'sponsor_id')->where('connection',1);
	}
    public function addedprofessional($id) {
        return (AddedProfessional::whereIn('id', EventProfessional::where('event_id',$id)->where('connection',2)->get(['professional_id']))->get());
//        return $this->belongsToMany( AddedProfessional::class, 'event_professional','event_id' ,'professional_id' )->where('connection',1);
    }

    public function addedcompany($id) {
//        return $this->hasMany( AddedCompany::class, 'event_company', 'company_id', 'event_id' );
        return (AddedCompany::whereIn('id', EventCompany::where('event_id',$id)->where('connection',2)->get(['company_id']))->get());

//        return $this->belongsToMany( AddedCompany::class, 'event_company', 'event_id','company_id' )->where('connection',2);

    }

    public function addedsponsor($id) {
        return (AddedSponsor::whereIn('id', EventSponsor::where('event_id',$id)->where('connection',2)->get(['sponsor_id']))->get());

//        return $this->hasMany( AddedSponsor::class, 'event_sponsor', 'sponsor_id', 'event_id' );
//        return $this->belongsToMany( AddedSponsor::class, 'event_sponsor', 'event_id','sponsor_id' )->where('connection',2);

    }
	public function attendes() {
		return $this->belongsToMany( User::class, 'booking', 'event_id', 'user_id' );
	}

	public function EventReviews() {
		return $this->hasMany( EventReviews::class );
	}

	public function city() {
		return $this->belongsTo( City::class, 'address_city' );
	}

	public function addressType() {
		return $this->belongsTo( AddressType::class, 'address_type' );
	}

	public function requireData() {
		return $this->hasMany( EventRequireData::class, 'event_id', 'id' );
	}

	public function multiplePrice() {
		return $this->hasMany( EventMultiplePrice::class);
	}

	public function location_name() {
		return $this->{'location_name_'.\App::getLocale()};
	}

	public function getMultiplePrice($id) {
		foreach($this->multiplePrice as $row){
			if($row->id==$id){
				return $row;
			}
		}
		return new EventMultiplePrice();
	}
    public function ratingpositive($event_id)
    {
        return (EventReviews::where('rating', 1)->where('event_id', $event_id)->count());
    }
    public function ratingneutral($event_id)
    {
        return (EventReviews::where('rating', 2)->where('event_id', $event_id)->count());
    }

    public function ratingnegative($event_id)
    {
        return (EventReviews::where('rating', 3)->where('event_id', $event_id)->count());

    }
    public function event_attendes_num($event_id)
    {
        return (Attendee::where('event_id', $event_id)->count());
	}
	
	public function booking() {
		return $this->hasMany(Booking::class);
	}

}
