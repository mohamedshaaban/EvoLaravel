<?php

namespace App\Http\Controllers\Events;

use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Category;
use App\Models\City;
use App\Models\customers;
use App\Models\Event;
use App\Models\EventInvitation;
use App\Models\EventReviews;
use App\Models\EventsUsers;
use App\Models\MainType;
use App\Models\ReportEvent;
use App\Models\UserFavoriteHosts;
use App\Models\Attendee;
use App\Models\UserStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\UserProfessions;
use App\Models\HostsUsers;
use App\Models\UserSocialMedia;
// use Symfony\Component\DomCrawler\Image;
use Illuminate\Support\Facades\Validator;
use App\Models\Currency;


use App\Models\Professions;
use App\Models\Country;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Session;
use Carbon\Carbon;

class EventsController extends Controller {

	public function list_events( Request $request ) {
		$mytime = Carbon::today()->format( 'Y-m-d' );

		return view( 'events.list' )
			->with( 'titlePage', 'Events' )
			->with( 'categories', Category::where( 'category_id', 0 )->get() )
			->with( 'types', MainType::all() )
			->with( 'countries', Country::all() )
			->with( 'locations', Event::distinct()->get( [ 'location_name_en' ] ) )
			->with( 'age_from', Event::distinct()->get( [ 'age_from' ] ) )
			->with( 'age_to', Event::distinct()->get( [ 'age_to' ] ) )
			->with( 'event_sliders', Event::where( 'main', 1 )->where( 'private_event', 0 )->whereIn( 'address_city', City::where( 'country_id', $request->session()->get( 'country' ) )->get( [ 'id' ] ) )->get() )
			->with( 'event_categories', Event::where( 'featured', 1 )->distinct()->get( [ 'category_id' ] ) )
			->with( 'events', Event::where( 'date_from', '<', $mytime )->where( 'private_event', 0 )->where( 'featured', 1 )->whereIn( 'address_city', City::where( 'country_id', $request->session()->get( 'country' ) )->get( [ 'id' ] ) )->get() );
	}

	public function search_events( Request $request ) {

	    if($request->date) {
            $dates = explode(',', $request->date);
            $date_from = date("Y-m-d", strtotime($dates[0]));
            $date_to= null;
            if(isset($dates[1]))
            {
                $date_to = date("Y-m-d", strtotime($dates[1]));
            }
            
        }
		$mytime = Carbon::today()->format( 'Y-m-d' );
		$query  = Event::select( '*' );
		if ( $request->type ) {
			$query->whereIn( 'main_type_id', (array) $request->type );
		}
		if ( $request->date ) {
			$query->Where( 'date_from', '>', $date_from );
                        if($date_to)
                        {
                            $query->Where( 'date_to', '<', $date_to );
                        }
			
		}

		if ( $request->category ) {
			$query->Where( 'category_id', $request->category );
//                        $query->WhereIn('category_id', $request->category);
		}
		if ( $request->age_from ) {
                    $ages = explode('-', $request->age_from);
			$query->Where( 'age_from', $ages[0] );
                        $query->Where( 'age_to', $ages[1] );
		}
		

		if ( $request->gender ) {
			if ( $request->gender == 3 ) {

			} else {
				$query->Where( 'gender', $request->gender );
			}

		}
                
                if($request->title)
                {
                
                    $query->Where( 'title_en','like', '%'.$request->title.'%' );
                 
                }
                
                $query->Where(function($q) use ($mytime) {
                    $q->Where( 'date_from', '>', $mytime );
                    $q->orwhere('date_to', '>', $mytime);
                });
		$query->whereIn( 'address_city', City::where( 'country_id', $request->session()->get( 'country' ) )->get( [ 'id' ] ) );
		$query->where( 'private_event', 0 );
//dd($query->get());
		return view( 'events.search' )
			->with( 'titlePage', 'Events' )
			->with( 'categories', Category::whereIn( 'id', $query->get( [ 'category_id' ] ) )->get() )
			->with( 'types', MainType::all() )
			->with( 'countries', Country::all() )
			->with( 'locations', Event::distinct()->get( [ 'location_name_en' ] ) )
			->with( 'age_from', Event::distinct()->get( [ 'age_from' ] ) )
			->with( 'age_to', Event::distinct()->get( [ 'age_to' ] ) )
			->with( 'event_categories', Category::whereIn( 'id', $query->get( [ 'category_id' ] ) )->get() )
			->with( 'event_sliders', $query->get() )
			->with( 'events', $query->get() );
	}

	public function event_details( Request $request ) {

//		dd(City::where('country_id', $request->session()->get('country')));

		$mytime         = Carbon::today()->format( 'Y-m-d' );
		$event_details  = Event::where( 'id', $request->event_id )->whereIn( 'address_city',
			City::where( 'country_id', $request->session()->get( 'country' ) )->get( [ 'id' ] )->pluck( 'id' )->toArray()
		)->first();
		$host_events    = Event::where( 'host_id', $event_details->host_id )->whereIn( 'address_city',
			City::where( 'country_id', $request->session()->get( 'country' ) )->get( [ 'id' ] )->pluck( 'id' )->toArray()
		)->limit( 5 )->get();
		$similar_events = Event::where( 'category_id', $event_details->category_id )->whereIn( 'address_city', City::where( 'country_id', $request->session()->get( 'country' ) )->get( [ 'id' ] ) )->limit( 5 )->get();

		return view( 'events.details' )
			->with( 'titlePage', 'Event Details' )
			->with( 'categories', Category::where( 'category_id', 0 )->get() )
			->with( 'types', MainType::all() )
			->with( 'countries', Country::all() )
			->with( 'locations', Event::distinct()->get( [ 'location_name_en' ] ) )
			->with( 'age_from', Event::distinct()->get( [ 'age_from' ] ) )
			->with( 'age_to', Event::distinct()->get( [ 'age_to' ] ) )
			->with( 'event_categories', Event::distinct()->get( [ 'category_id' ] ) )
			->with( 'event', $event_details )
			->with( 'host_events', $host_events )
			->with( 'similar_events', $similar_events );
	}

	public function host_events( Request $request ) {
		return view( 'events.search' )
			->with( 'titlePage', 'Events' )
			->with( 'categories', Category::where( 'category_id', 0 )->get() )
			->with( 'types', MainType::all() )
			->with( 'countries', Country::all() )
			->with( 'locations', Event::distinct()->get( [ 'location_name_en' ] ) )
			->with( 'age_from', Event::distinct()->get( [ 'age_from' ] ) )
			->with( 'age_to', Event::distinct()->get( [ 'age_to' ] ) )
			->with( 'event_categories', Event::distinct()->get( [ 'category_id' ] ) )
			->with( 'event_sliders', Event::where( 'main', 1 )->get() )
			->with( 'events', Event::where( 'host_id', $request->host_id )->whereIn( 'address_city', City::where( 'country_id', $request->session()->get( 'country' ) )->get( [ 'id' ] ) )->get() );
	}

	public function type_events( Request $request ) {
		return view( 'events.search' )
			->with( 'titlePage', 'Events' )
			->with( 'categories', Category::where( 'category_id', 0 )->get() )
			->with( 'types', MainType::all() )
			->with( 'countries', Country::all() )
			->with( 'locations', Event::distinct()->get( [ 'location_name_en' ] ) )
			->with( 'age_from', Event::distinct()->get( [ 'age_from' ] ) )
			->with( 'age_to', Event::distinct()->get( [ 'age_to' ] ) )
			->with( 'event_categories', Event::distinct()->get( [ 'category_id' ] ) )
			->with( 'event_sliders', Event::where( 'main', 1 )->get() )
			->with( 'events', Event::where( 'main_type_id', $request->type_id )->whereIn( 'address_city', City::where( 'country_id', $request->session()->get( 'country' ) )->get( [ 'id' ] ) )->get() );
	}

	public function review_event( Request $request ) {
		$validator = Validator::make( $request->all(), [
			'user_id'  => 'required',
			'event_id' => 'required',
			'comment'  => 'required',
			'rating'   => 'required',
		] );
		$chk       = EventReviews::where( 'user_id', $request->user_id )->where( 'event_id', $request->event_id )->first();
		if ( $chk ) {
			Session::flash( 'alert', 'You already rated it' );

			return redirect()->route( 'event_details', [ 'event_id' => $request->event_id ] );
		}
        $event = Event::findOrFail($request->event_id);
        UserStatus::create(['user_id' => Auth::id() , 'description' =>'Reviewed Event '.$event->title_en]);

        $event_review           = new EventReviews();
		$event_review->user_id  = $request->user_id;
		$event_review->event_id = $request->event_id;
		$event_review->comment  = $request->comment;
		$event_review->rating   = $request->rating;

		if ( $event_review->save() ) {
			Session::flash( 'message', 'Your review sent successfully' );
		} else {
			Session::flash( 'alert', 'Sorry review not sent ' );
		}

		return redirect()->route( 'event_details', [ 'event_id' => $request->event_id ] );
	}

	public function report_event( Request $request ) {
		$validator = Validator::make( $request->all(), [
			'user_id'  => 'required',
			'event_id' => 'required',
			'comment'  => 'required',
		] );
		$chk       = ReportEvent::where( 'reporter_id', $request->user_id )->where( 'event_id', $request->event_id )->first();
		if ( $chk ) {
			Session::flash( 'alert', 'You already sent report ' );

			return redirect()->route( 'event_details', [ 'event_id' => $request->event_id ] );
		}
		$event_review              = new ReportEvent();
		$event_review->reporter_id = $request->user_id;
		$event_review->event_id    = $request->event_id;
		$event_review->problem     = $request->comment;


		if ( $event_review->save() ) {
			Session::flash( 'message', 'Your problem sent successfully' );
		} else {
			Session::flash( 'alert', 'Sorry problem not sent ' );
		}

		return redirect()->route( 'event_details', [ 'event_id' => $request->event_id ] );
	}

	public function booking( $id ) {
	    $event = Event::findOrFail( $id ) ;
        UserStatus::create(['user_id' => Auth::id() , 'description' =>'Attend Event '.$event->title_en]);
		return view( 'events.booking' )
			->with( 'event', Event::with( [
				'media',
				'category.parent',
				'host',
				'multiplePrice.groupPrice'
			] )->findOrFail( $id ) );
	}

	public function placeOrder( $id, Request $request ) {
		$error = false;

		if ( in_array( $request->get( 'quantity', '' ), [ '', '[]', '{}' ] ) ) {
			$error = true;
		}

		if ( $error ) {
			Session::flash( 'alert', 'You have not selected any ticket number' );

			return redirect()->route( 'event.booking', $id );
		}

		return view( 'events.place_order' )
			->with( 'event', Event::with( [
				'media',
				'category.parent',
				'host',
				'multiplePrice.groupPrice'
			] )->findOrFail( $id ) );
	}

	public function checkout( $id, Request $request ) {

		$vali = Validator::make( $request->all(), [
			'name'     => 'required',
			'email'    => 'required',
			'mobile'   => 'required',
			'quantity' => 'required',
		] );

		if ( $vali->fails() ) {
			return redirect()->back()->withInput()->withErrors( $vali );
		}
		$currency = Currency::where( 'code', session()->get( 'currency' ) )->first();
		$event    = Event::findOrFail( $id );

		$total = 0;


		foreach ( json_decode( $request->get( 'quantity' ), true ) as $key => $val ) {

			if ( $event->use_seatmap ) {
				$multiP   = $event->getMultiplePrice( $val['typeId'] );
				$subTotal = $multiP->getTotalPrice( count( $val['seats'] ) );
			} elseif ( $event->multi_price == 1 ) {
				$multiP   = $event->getMultiplePrice( $key );
				$subTotal = $multiP->getTotalPrice( $val );
			} else {
				$multiP   = null;
				$subTotal = $val * $event->fee;
			}
			$total += $subTotal;
		}

		$total += round( $total / $currency->value, 2 );


		$booking = new Booking();

		$booking->user_id      = auth()->id();
		$booking->event_id     = $id;
		$booking->total        = $total;
		$booking->payment_type = $request->get( 'payment_type' );
		$booking->name         = $request->get( 'name' );
		$booking->email        = $request->get( 'email' );
		$booking->mobile       = $request->get( 'mobile' );
		$booking->status       = Booking::STATUS_PENDING;

		$booking->save();

		foreach ( json_decode( $request->get( 'quantity' ), true ) as $key => $val ) {

			$bookingDetail = new BookingDetail();

			$bookingDetail->booking_id = $booking->id;

			if ( $event->use_seatmap ) {
				$bookingDetail->multiple_price_id = $val['typeId'];
				$bookingDetail->quantity          = count( $val['seats'] );

				$multiP = $event->getMultiplePrice( $val['typeId'] );

				$bookingDetail->total_price = round( $multiP->getTotalPrice( count( $val['seats'] ) ) / $currency->value, 2 );
			} elseif ( $event->multi_price == 1 ) {
				$bookingDetail->multiple_price_id = $key;
				$bookingDetail->quantity          = $val;

				$multiP                     = $event->getMultiplePrice( $key );
				$bookingDetail->total_price = round( $multiP->getTotalPrice( $val ) / $currency->value, 2 );
			} else {
				$bookingDetail->multiple_price_id = 0;
				$bookingDetail->quantity          = $val;

				$bookingDetail->total_price = round( $val * $event->fee / $currency->value, 2 );
			}

			$bookingDetail->save();

			$num = 0;


			if ( $event->use_seatmap ) {
				$bookingDetail->multiple_price_id = $val['typeId'];
				$bookingDetail->quantity          = count( $val['seats'] );

				$multiP = $event->getMultiplePrice( $val['typeId'] );

				$bookingDetail->total_price = round( $multiP->getTotalPrice( count( $val['seats'] ) ) / $currency->value, 2 );
			} elseif ( $event->multi_price == 1 ) {
				$bookingDetail->multiple_price_id = $key;
				$bookingDetail->quantity          = $val;

				$multiP                     = $event->getMultiplePrice( $key );
				$bookingDetail->total_price = round( $multiP->getTotalPrice( $val ) / $currency->value, 2 );
			} else {
				$bookingDetail->multiple_price_id = 0;
				$bookingDetail->quantity          = $val;

				$bookingDetail->total_price = round( $val * $event->fee / $currency->value, 2 );
			}

			if ( $event->use_seatmap ) {
				foreach ( $val['seats'] as $seats ) {

					$num ++;

					$attendee = new Attendee();

					$attendee->booking_id  = $booking->id;
					$attendee->event_id    = $id;
					$attendee->seat_no     = $seats['seatName'];
					$attendee->seat_id     = $seats['seatId'];
					$attendee->ticket_type = $val['typeId'];
					$attendee->name        = $request->get( 'name' );
					$attendee->email       = $request->get( 'email' );
					$attendee->qr          = $booking->id . time() . substr( 1000 + $num, 1 );
					$attendee->mobile      = $request->get( 'mobile' );
					$attendee->status      = Attendee::STATUS_NOT_SET;
					$attendee->canceled_at = null;
					$attendee->arrived_at  = null;

					$attendee->save();
				}
			} else {
                            
				foreach ( range( 1, $val ) as $seats ) {

					$num ++;

					$attendee = new Attendee();

					$attendee->booking_id  = $booking->id;
					$attendee->event_id    = $id;
					$attendee->seat_no     = '-';
					$attendee->seat_id     = 0;
					$attendee->ticket_type = $key;
					$attendee->name        = $request->get( 'name' );
					$attendee->email       = $request->get( 'email' );
					$attendee->qr          = $booking->id . time() . substr( 1000 + $num, 1 );
					$attendee->mobile      = $request->get( 'mobile' );
					$attendee->status      = Attendee::STATUS_NOT_SET;
					$attendee->canceled_at = null;
					$attendee->arrived_at  = null;

					$attendee->save();
				}
			}
		}


		return redirect()->route( 'event.thank_you', $booking->id )->withInput();
	}

	public function thankYou( $id ) {

		$booking = Booking::with( [ 'event', 'details.groupPrice' ] )->findOrFail( $id );

		return view( 'events.thank_you' )->with( 'booking', $booking );

	}

	public function thisweek( Request $request ) {
		$monday = date( 'Y-m-d', strtotime( 'monday this week' ) );
		$sunday = date( 'Y-m-d', strtotime( 'sunday this week' ) );

		$query = Event::select( '*' );

		$query->whereDate( 'date_from', '<=', $sunday );
		$query->whereDate( 'date_to', '>=', $monday );
		$query->where( 'private_event', 0 );
		$query->whereIn( 'address_city', City::where( 'country_id', $request->session()->get( 'country' ) )->get( [ 'id' ] ) );
		$cats = array();
		foreach ( $query->get() as $event ) {
			if ( ! in_array( $event->category_id, $cats ) ) {
				$cats[] = $event->category_id;
			}
		}

//     dd( Category::whereIn( 'id', $query->get(['category_id']) )->get());
		return view( 'events.search' )
			->with( 'titlePage', 'Events' )
			->with( 'categories', Category::whereIn( 'id', $query->get( [ 'category_id' ] ) )->get() )
			->with( 'types', MainType::all() )
			->with( 'countries', Country::all() )
			->with( 'locations', Event::distinct()->get( [ 'location_name_en' ] ) )
			->with( 'age_from', Event::distinct()->get( [ 'age_from' ] ) )
			->with( 'age_to', Event::distinct()->get( [ 'age_to' ] ) )
			->with( 'event_categories', Category::whereIn( 'id', $cats )->get() )
			->with( 'event_sliders', Event::where( 'main', 1 )->get() )
			->with( 'events', $query->get() );

	}

	public function list_events_category( Request $request ) {
		$monday = date( 'Y-m-d', strtotime( 'monday this week' ) );
		$sunday = date( 'Y-m-d', strtotime( 'sunday this week' ) );

		$query = Event::select( '*' );

		$query->whereDate( 'date_from', '<=', $sunday );
		$query->whereDate( 'date_to', '>=', $monday );
		$query->where( 'private_event', 0 );
		$query->whereIn( 'address_city', City::where( 'country_id', $request->session()->get( 'country' ) )->get( [ 'id' ] ) );
		$cats = array();
		foreach ( $query->get() as $event ) {
			if ( ! in_array( $event->category_id, $cats ) ) {
				$cats[] = $event->category_id;
			}
		}

//     dd( Category::whereIn( 'id', $query->get(['category_id']) )->get());
		return view( 'events.search' )
			->with( 'titlePage', 'Events' )
			->with( 'categories', Category::whereIn( 'id', $query->get( [ 'category_id' ] ) )->get() )
			->with( 'types', MainType::all() )
			->with( 'countries', Country::all() )
			->with( 'locations', Event::distinct()->get( [ 'location_name_en' ] ) )
			->with( 'age_from', Event::distinct()->get( [ 'age_from' ] ) )
			->with( 'age_to', Event::distinct()->get( [ 'age_to' ] ) )
			->with( 'event_categories', Category::whereIn( 'id', $cats )->get() )
			->with( 'event_sliders', Event::where( 'main', 1 )->get() )
			->with( 'events', $query->get() );

	}

	public function thisweekend( Request $request ) {
		$mytime = Carbon::today()->format( 'Y-m-d' );

		return view( 'events.search' )
			->with( 'titlePage', 'Events' )
			->with( 'categories', Category::where( 'category_id', 0 )->get() )
			->with( 'types', MainType::all() )
			->with( 'countries', Country::all() )
			->with( 'locations', Event::distinct()->get( [ 'location_name_en' ] ) )
			->with( 'age_from', Event::distinct()->get( [ 'age_from' ] ) )
			->with( 'age_to', Event::distinct()->get( [ 'age_to' ] ) )
			->with( 'event_sliders', Event::where( 'main', 1 )->where( 'private_event', 0 )->get() )
			->with( 'event_categories', Event::where( 'featured', 1 )->distinct()->get( [ 'category_id' ] ) )
			->with( 'events', Event::where( 'date_to', '>', $mytime )->where( 'private_event', 0 )->where( 'category_id', $request->category_id )->whereIn( 'address_city', City::where( 'country_id', $request->session()->get( 'country' ) )->get( [ 'id' ] ) )->get() );

	}

	public function calendar( Request $request ) {
		$mytime     = Carbon::today()->format( 'Y-m-d' );
		$countries  = Country::all();
		$myevents   = Event::where( 'date_to', '>', $mytime )->where( 'private_event', 0 )->whereIn( 'address_city', City::where( 'country_id', $request->session()->get( 'country' ) )->get( [ 'id' ] ) )->get();
		$types      = MainType::all();
		$categories = Category::all();
		$calevents  = array();
		foreach ( $myevents as $event ) {
			if ( $event->type == Event::TYPE_EVENT ) {
				$event_color = Event::EVENT_COLOR;
			} else if ( $event->type == Event::TYPE_ACTIVITY ) {
				$event_color = Event::ACTIVITY_COLOR;
			} else {
				$event_color = Event::SERVICE_COLOR;
			}
			$calevents[] = "{id: $event->id,title: \"" . $event->title_en . "\",start: \"" . $event->date_from . "\",end: \"" . $event->date_to . "\",color:\"$event_color\" }";

		}

		$allevents = implode( ',', $calevents );

		return view( 'events.calendar', [
			'myevents'   => $allevents,
			'countries'  => $countries,
			'types'      => $types,
			'categories' => $categories
		] );

	}
}

