<?php
/**
 * Created by PhpStorm.
 * User: Abdelqader Osama
 * Date: 10/1/18
 * Time: 11:16 AM
 */

namespace App\Http\Controllers\Event;

use App\Http\Controllers\Controller;
use App\Models\AddedCompany;
use App\Models\AddedProfessional;
use App\Models\AddedSponsor;
use App\Models\AddressType;
use App\Models\BalanceTransaction;
use App\Models\Category;
use App\Models\Country;
use App\Models\Event;
use App\Models\EventCompany;
use App\Models\EventGroupPrice;
use App\Models\EventMedia;
use App\Models\EventMultiplePrice;
use App\Models\EventProfessional;
use App\Models\EventRequireData;
use App\Models\EventSponsor;
use App\Models\MainType;
use App\Models\Media;
use App\Models\RequireData;
use App\User;
use DB;
use App\Mail\NotifyInvitation;
use Mail;
use Illuminate\Http\Request;
use \Validator;

class CreateController extends Controller {

	public function index() {

		$mainType = MainType::all();

		return view( 'event.create' )
			->with( 'mainTypeEvents', array_values( $mainType->filter( function ( $row ) {
				return $row->event_type == MainType::EVENT_TYPE_EVENT;
			} )->toArray() ) )
			->with( 'mainTypeActivity', array_values( $mainType->filter( function ( $row ) {
				return $row->event_type == MainType::EVENT_TYPE_ACTIVITY;
			} )->toArray() ) )
			->with( 'mainTypeService', array_values( $mainType->filter( function ( $row ) {
				return $row->event_type == MainType::EVENT_TYPE_SERVICE;
			} )->toArray() ) )
			->with( 'categories', Category::all( [ 'id', 'name_en', 'name_ar', 'category_id' ] ) )
			->with( 'addressType', AddressType::all() )
			->with( 'requireData', RequireData::where( 'status', 1 )->get() );
	}

	public function news( Request $request ) {

		return [
			'status' => true,
			'html'   => view( 'event.news' )->render()
		];
	}

	public function save( Request $request ) {


		$validator = Validator::make( $request->all(), [
			'event-types'    => 'required|exists:main_type,id',
			'title_en'       => 'required',
			'title_ar'       => 'required',
			'description_en' => 'required',
			'description_ar' => 'required',
			'category'       => 'required|exists:category,id',
			'date_from'      => 'required|date',
			'date_to'        => 'required|date',
			'time_from'      => 'required',
			'time_to'        => 'required',
		] );

		if ( $validator->fails() ) {
			return [ 'status' => false, 'msg' => $validator->errors()->all() ];
		}

		$hostID =Auth()->user()->id;

		$startDate = date_create_from_format( 'm/d/Y', $request->get( 'date_from' ) );
		$endDate   = date_create_from_format( 'm/d/Y', $request->get( 'date_to' ) );

		$path = 'uploads/tmp/' . date( 'Ymd' );

		if ( ! file_exists( public_path( $path ) ) ) {
			mkdir( public_path( $path ), 0777, true );
		}

		$seat_map_img = "";

		if($file = $request->file('seat_map_img')) {
			$path = $file->move( $path, $this->checkFilePath( $path, $file->getFilename(), $file->getMimeType() ) )->getPathname();

			$seat_map_img = $this->moveFile($path, 'uploads/event/' . $hostID);
		}

		$mainPic = $this->moveFile( $request->get( 'main-pic' ), 'uploads/event/' . $hostID );


		$files = [];

		foreach ( $request->get( 'myfiles' ) as $key => $file ) {
			if ( ! ( $file == '' || $file == null ) ) {
				$files[] = $this->moveFile( $file, 'uploads/event/' . $hostID );
			}
		}

		$eventID = $this->saveEvent($hostID, $request, $seat_map_img, $mainPic, $files, $startDate->format( 'Y-m-d' ), $endDate->format( 'Y-m-d' ));



		if($request->get('repeat', false)){

			$diff = date_create_from_format( 'm/d/Y', $request->get( 'date_from' ) )->diff($endDate)->d;

			foreach($request->get('repeat_date', []) as $row) {
				if($row==''){
					continue;
				}

				$start = date_create_from_format( 'm/d/Y', $row);
				$end = date_create_from_format( 'm/d/Y', $row);
				$end->add(new \DateInterval('P'.$diff.'D'));

				$this->saveEvent($hostID, $request, $seat_map_img, $mainPic, $files, $start->format( 'Y-m-d' ), $end->format( 'Y-m-d' ));
			}
		}

		return [
			'status' => true,
			'url'    => route( 'event_details', $eventID )
		];

	}

	public function livePreview1( Request $request ) {

//		return redirect()->route( 'event.live_preview2' )->withInput();
//	}
//
//	public function livePreview2() {
		if ( auth()->check() ) {
			$host_events = Event::where( 'host_id', auth()->id() )->limit( 5 )->get();
		} else {
			$host_events = Event::limit( 5 )->get();
		}

		$similar_events = Event::where( 'category_id', request( "category" ) )->limit( 5 )->get();

		return view( 'events.preview_details' )
			->with( 'host_events', $host_events )
			->with( 'similar_events', $similar_events );
	}

	public function upload_files( Request $request ) {

		$validator = Validator::make( $request->all(), [
			'file' => 'image|mimes:jpg,jpeg,png'
		] );

		if ( $validator->fails() ) {
			return [ 'status' => false, 'msg' => 'file is not accept' ];
		}

		$path = 'uploads/tmp/' . date( 'Ymd' );

		if ( ! file_exists( public_path( $path ) ) ) {
			mkdir( public_path( $path ), 0777, true );
		}

		/** @var $file \Symfony\Component\HttpFoundation\File\UploadedFile */
		$file = $request->file( 'file' );

		$path = $file->move( $path, $this->checkFilePath( $path, $file->getFilename(), $file->getMimeType() ) )->getPathname();

		return [ 'status' => true, 'data' => $path ];
	}

	public function professional() {
		$addedProfessional = AddedProfessional
			::where( 'status', 1 )
			->where( function ( $query ) {
				$query->where( 'name_en', 'like', '%' . request( 'term' ) . '%' );
				$query->orWhere( 'name_ar', 'like', '%' . request( 'term' ) . '%' );
			} )
			->limit( 8 )
			->get( [ 'id', 'name_en', 'name_ar', 'img' ] );

		$userProfessional = DB::select( "select users.id , company_name as name_en, company_name as name_ar, avatar as img from users join hosts_users h on users.id = h.user_id where users.type =? and company_name like ?",
			[ User::PROFESSIONAL_USER_TYPE_ID, '%' . request( 'term' ) . '%' ] );


		return [ 'status' => true, 'data' => array_merge( $addedProfessional->toArray(), $userProfessional ) ];
	}

	public function add_professional( Request $request ) {


		$validator = Validator::make( $request->all(), [
			'name' => 'required',
			'file' => 'image|mimes:jpg,jpeg,png'
		] );

		if ( $validator->fails() ) {
			return [ 'status' => false, 'msg' => 'file is not accept' ];
		}

		$path = 'uploads/professional';

		if ( ! file_exists( public_path( $path ) ) ) {
			mkdir( public_path( $path ), 0777, true );
		}

		/** @var $file \Symfony\Component\HttpFoundation\File\UploadedFile */
		$file = $request->file( 'file' );

		$path = $file->move( $path, $this->checkFilePath( $path, $file->getFilename(), $file->getMimeType() ) )->getPathname();


		$addedProfessional = new AddedProfessional();

		$addedProfessional->name_en  = $request->get( 'name' );
		$addedProfessional->name_ar  = $request->get( 'name' );
		$addedProfessional->img      = $path;
		$addedProfessional->status   = 0;
		$addedProfessional->added_by = auth()->id();

		$addedProfessional->save();

		return [ 'status' => true, 'data' => $addedProfessional->id ];
	}

	public function company() {
		$addedCompany = AddedCompany
			::where( 'status', 1 )
			->where( function ( $query ) {
				$query->where( 'name_en', 'like', '%' . request( 'term' ) . '%' );
				$query->orWhere( 'name_ar', 'like', '%' . request( 'term' ) . '%' );
			} )
			->limit( 8 )
			->get( [ 'id', 'name_en', 'name_ar', 'img' ] );

		$userCompany = DB::select( "select cast(users.id as SIGNED)*-1 as id, company_name as name_en, company_name as name_ar, avatar as img from users join hosts_users h on users.id = h.user_id where users.type =? and company_name like ?",
			[ User::COMPANY_USER_TYPE_ID, '%' . request( 'term' ) . '%' ] );


		return [ 'status' => true, 'data' => array_merge( $addedCompany->toArray(), $userCompany ) ];
	}

	public function add_company( Request $request ) {


		$validator = Validator::make( $request->all(), [
			'name' => 'required',
			'file' => 'image|mimes:jpg,jpeg,png'
		] );

		if ( $validator->fails() ) {

			return [ 'status' => false, 'msg' => 'file is not accept' ];
		}

		$path = 'uploads/company';

		if ( ! file_exists( public_path( $path ) ) ) {
			mkdir( public_path( $path ), 0777, true );
		}

		/** @var $file \Symfony\Component\HttpFoundation\File\UploadedFile */
		$file = $request->file( 'file' );

		$path = $file->move( $path, $this->checkFilePath( $path, $file->getFilename(), $file->getMimeType() ) )->getPathname();


		$addedCompany = new AddedCompany();

		$addedCompany->name_en  = $request->get( 'name' );
		$addedCompany->name_ar  = $request->get( 'name' );
		$addedCompany->img      = $path;
		$addedCompany->status   = 0;
		$addedCompany->added_by = auth()->id();

		$addedCompany->save();

		return [ 'status' => true, 'data' => $addedCompany->id ];
	}

	public function sponsor() {
		$addedSponsor = AddedSponsor
			::where( 'status', 1 )
			->where( function ( $query ) {
				$query->where( 'name_en', 'like', '%' . request( 'term' ) . '%' );
				$query->orWhere( 'name_ar', 'like', '%' . request( 'term' ) . '%' );
			} )
			->limit( 8 )
			->get( [ 'id', 'name_en', 'name_ar', 'img' ] );

		$userSponsor = DB::select( "select cast(users.id as SIGNED)*-1 as id, company_name as name_en, company_name as name_ar, avatar as img from users join hosts_users h on users.id = h.user_id where users.type =? and company_name like ?",
			[ User::GROUP_USER_TYPE_ID, '%' . request( 'term' ) . '%' ] );


		return [ 'status' => true, 'data' => array_merge( $addedSponsor->toArray(), $userSponsor ) ];
	}

	public function add_sponsor( Request $request ) {

		$validator = Validator::make( $request->all(), [
			'name' => 'required',
			'file' => 'image|mimes:jpg,jpeg,png'
		] );

		if ( $validator->fails() ) {
			return [ 'status' => false, 'msg' => 'file is not accept' ];
		}

		$path = 'uploads/sponsor';

		if ( ! file_exists( public_path( $path ) ) ) {
			mkdir( public_path( $path ), 0777, true );
		}

		/** @var $file \Symfony\Component\HttpFoundation\File\UploadedFile */
		$file = $request->file( 'file' );

		$path = $file->move( $path, $this->checkFilePath( $path, $file->getFilename(), $file->getMimeType() ) )->getPathname();


		$addedSponsor = new AddedSponsor();

		$addedSponsor->name_en  = $request->get( 'name' );
		$addedSponsor->name_ar  = $request->get( 'name' );
		$addedSponsor->img      = $path;
		$addedSponsor->status   = 0;
		$addedSponsor->added_by = auth()->id();

		$addedSponsor->save();

		return [ 'status' => true, 'data' => $addedSponsor->id ];
	}

	private function checkFilePath( $path, $name, $mime ) {

		$ext = '';
		switch ( strtolower( $mime ) ) {
			case 'image/jpeg':
				$ext = '.jpeg';
				break;
			case 'image/jpg':
				$ext = '.jpg';
				break;
			case 'image/png':
				$ext = '.png';
				break;
		}

		while ( file_exists( $path . DIRECTORY_SEPARATOR . $name . $ext ) ) {
			$name = str_random( 10 );
		}

		return $name . $ext;
	}

	private function moveFile( $path, $newPath ) {

		if ( ! file_exists( public_path( $newPath ) ) ) {
			mkdir( public_path( $newPath ), 0777, true );
		}

		$name = basename( $path );
		$ext  = explode( '.', $name, 1 );
		$name = $ext[0];
		$ext  = count( $ext ) == 2 ? $ext[1] : '';

		while ( file_exists( $newPath . DIRECTORY_SEPARATOR . $name . $ext ) ) {
			$name = str_random( 10 );
		}

		if ( @rename( $path, $newPath . DIRECTORY_SEPARATOR . $name . $ext ) ) {
			return $newPath . DIRECTORY_SEPARATOR . $name . $ext;
		} else {
			return $path;
		}
	}

	protected function saveEvent($hostID, $request, $seat_map_img, $mainPic, $files, $startDate, $endDate) {
		$event                       = new Event();
		$event->type                 = MainType::findOrFail( $request->get( 'event-types' ) )->event_type;
		$event->main_type_id         = $request->get( 'event-types' );
		$event->host_id              = $hostID;
		$event->title_en             = $request->get( 'title_en' );
		$event->title_ar             = $request->get( 'title_ar' );
		$event->description_en       = $request->get( 'description_en' );
		$event->description_ar       = $request->get( 'description_ar' );
		$event->category_id          = $request->get( 'category' );
		$event->date_from            = $startDate;
		$event->date_to              = $endDate;
		$event->time_from            = $request->get( 'time_from' ) . ":00";
		$event->time_to              = $request->get( 'time_to' ) . ":00";
		$event->break_from           = $request->get( 'break_from' ) . ":00";
		$event->break_to             = $request->get( 'break_to' ) . ":00";
		$event->location_name_en     = $request->get( 'location_name_en' );
		$event->location_name_ar     = $request->get( 'location_name_ar' );
		$event->address_lat          = $request->get( 'address_lat' );
		$event->address_long         = $request->get( 'address_long' );
		$event->address_text         = $request->get( 'address_text' );
		$event->address_type         = $request->get( 'address_type' );
		$event->address_city         = $request->get( 'address_city' );
		$event->address_block        = $request->get( 'address_block', '' );
		$event->address_street       = $request->get( 'address_street', '' );
		$event->address_avenue       = $request->get( 'address_avenue', '' );
		$event->address_building     = $request->get( 'address_building', '' );
		$event->address_floor        = $request->get( 'address_floor', '' );
		$event->age_from             = $request->get( 'age_from' , 0);
		$event->age_to               = $request->get( 'age_to' , 0);
		$event->gender               = $request->get( 'gender' , Event::GENDER_BOTH);
		$event->seating_booking_type = $request->get( 'seating_booking_type' );
		$event->booking_per_user     = $request->get( 'booking_per_user' );
		$event->location_id          = $request->get( 'location_id' );
		$event->venue_id             = $request->get( 'venue_id' );
		$event->cols                 = $request->get( 'cols' ) ?: 0;
		$event->rows                 = $request->get( 'rows' ) ?: 0;
		$event->seat_map_data        = $request->get( 'seatmap', false)?: '[]';
		$event->capacity             = $request->get( 'capacity');
		$event->cancellation         = $request->get( 'cancellation', 0 );
		$event->cancellation_days    = $request->get( 'cancellation_days' ) ?: 0;
		$event->attendees_listing    = $request->get( 'attendees_listing' ) ?: 0;
		$event->seat_map_img         = $seat_map_img;
		$event->qr_code              = $request->get( 'make_qr_code' ) ?: 0;
		$event->private_event        = $request->get( 'private_event' ) ?: 0;
		$event->use_seatmap          = $request->get( 'use_seatmap' ) ?: 0;
		$event->fee                  = 0;
		$event->published_at         = now();
		$event->created_at           = date( 'Y-m-d H:i:s' );

		if ( $request->get( 'fee_type' ) == 1 ) {
			if ( $request->get( 'multi_price' ) == 0 ) {
				$event->fee = $request->get( 'fee', 0 );
			}
		}

		$event->save();

		if ( $request->get( 'fee_type' ) == 1 ) {

			$event->multi_price = 0;
			$ids                = [];

			$rows = json_decode($request->get( 'seatmap' , '[]'), 1);
			$rows = $rows ?: [];

			foreach ( $request->get( 'event_multiple_price_name_en', [] ) as $key => $val ) {
				if ( ! ( $val == '' || $val == null ) ) {
					$event->multi_price = 1;

					$multiPriceRow = new EventMultiplePrice();

					$multiPriceRow->event_id   = $event->id;
					$multiPriceRow->name_en    = $val;
					$multiPriceRow->name_ar    = $request->get( 'event_multiple_price_name_en' )[ $key ];
					$multiPriceRow->cost       = $request->get( 'event_multiple_price_cost' )[ $key ];
					$multiPriceRow->created_at = now();
					$multiPriceRow->save();


					foreach ($rows as &$row1) {
						if($row1['value']==$multiPriceRow->name_en) {
							$row1['id'] = $multiPriceRow->id;
						}
					}
				}
			}

			$event->seat_map_data = json_encode($rows);


			$event->group_price = 0;
			foreach ( $request->get( 'event_group_price_price_type_id', [] ) as $key => $val ) {
				if ( ! ( $val == '' || $val == null ) ) {
					$event->group_price = 1;

					if ( ! isset( $ids[ $request->get( 'event_group_price_price_type_id' )[ $key ] ] ) ) {
						continue;
					}

					$groupPriceRow = new EventGroupPrice();

					$groupPriceRow->event_id      = $event->id;
					$groupPriceRow->price_type_id = $ids[ $request->get( 'event_group_price_price_type_id' )[ $key ] ];
					$groupPriceRow->ticket_no     = $request->get( 'event_group_price_ticket_no' )[ $key ];
					$groupPriceRow->price         = $request->get( 'event_group_price_price' )[ $key ];
					$groupPriceRow->created_at    = now();
					$groupPriceRow->save();
				}
			}
		}

		$media = new Media();

		$media->caption  = 'main';
		$media->link     = $mainPic;
		$media->type     = Media::TYPE_IMAGE;
		$media->owner_id = $hostID;

		$media->save();

		$eventMedia = new EventMedia();

		$eventMedia->event_id   = $event->id;
		$eventMedia->media_id   = $media->id;
		$eventMedia->created_at = now();

		$eventMedia->save();

		foreach ( $files as $key => $file ) {
				$media           = new Media();
				$media->caption  = $request->get( 'files_caption' )[ $key ];
				$media->link     = $file;
				$media->type     = Media::TYPE_IMAGE;
				$media->owner_id = $hostID;

				$media->save();

				$eventMedia = new EventMedia();

				$eventMedia->event_id   = $event->id;
				$eventMedia->media_id   = $media->id;
				$eventMedia->created_at = now();

				$eventMedia->save();
		}

		foreach ( $request->get( 'video_link' ) as $key => $link ) {
			if ( ! ( $link == '' || $link == null ) ) {

				$media           = new Media();
				$media->caption  = $request->get( 'video_caption' )[ $key ];
				$media->link     = $link;
				$media->type     = Media::TYPE_VIDEO;
				$media->owner_id = $hostID;

				$media->save();

				$eventMedia = new EventMedia();

				$eventMedia->event_id   = $event->id;
				$eventMedia->media_id   = $media->id;
				$eventMedia->created_at = now();

				$eventMedia->save();
			}
		}

		foreach ( $request->all() as $key => $value ) {
			if ( strpos( $key, 'require_data_id_' ) !== false ) {
				$eventRequireData = new EventRequireData();

				$eventRequireData->event_id        = $event->id;
				$eventRequireData->require_data_id = $value;
				$eventRequireData->created_at      = now();

				$eventRequireData->save();
			}
		}

		foreach ( $request->get( 'event_professional_professional_id', [] ) as $value ) {
                    
                        
			$eventProfessional = new EventProfessional();

			$eventProfessional->event_id        = $event->id;
			$eventProfessional->professional_id = abs( $value );
			$eventProfessional->setAttribute( 'connection',  EventProfessional::CONNECTION_USERS_TABLE  );
			$eventProfessional->created_at = now();

			$eventProfessional->save();
		}

		foreach ( $request->get( 'event_company_company_id', [] ) as $value ) {
                    $user = User::find($value);
			$eventCompany             = new EventCompany();
			$eventCompany->event_id   = $event->id;
			$eventCompany->company_id = abs( $value );
			$eventProfessional->setAttribute( 'connection', EventCompany::CONNECTION_USERS_TABLE );
			$eventCompany->created_at = now();
			$eventCompany->save();
		}

		foreach ( $request->get( 'event_sponsor_sponsor_id', [] ) as $value ) {
                    $user = User::find($value);
			$eventProfessional             = new EventSponsor();
			$eventProfessional->event_id   = $event->id;
			$eventProfessional->sponsor_id = abs( $value );
			$eventProfessional->setAttribute( 'connection', EventSponsor::CONNECTION_USERS_TABLE);
			$eventProfessional->created_at = now();
			$eventProfessional->save();
		}
		
                foreach ( $request->get( 'event_added_professional_professional_id', [] ) as $value ) {
                    
                    
			$eventProfessional = new EventProfessional();

			$eventProfessional->event_id        = $event->id;
			$eventProfessional->professional_id = abs( $value );
			$eventProfessional->setAttribute( 'connection',  EventProfessional::CONNECTION_ADDED_TABLE );
			$eventProfessional->created_at = now();

			$eventProfessional->save();
		}
                
		foreach ( $request->get( 'event_added_company_company_id', [] ) as $value ) {
                    
			$eventCompany             = new EventCompany();
			$eventCompany->event_id   = $event->id;
			$eventCompany->company_id = abs( $value );
			$eventCompany->setAttribute( 'connection', EventCompany::CONNECTION_ADDED_TABLE );
			$eventCompany->created_at = now();
			$eventCompany->save();
                        
		}

		foreach ( $request->get( 'event_added_sponsor_sponsor_id', [] ) as $value ) {
                    
			$eventProfessional             = new EventSponsor();
			$eventProfessional->event_id   = $event->id;
			$eventProfessional->sponsor_id = abs( $value );
			$eventProfessional->setAttribute( 'connection', EventSponsor::CONNECTION_ADDED_TABLE );
			$eventProfessional->created_at = now();
			$eventProfessional->save();
		}

		if ( count( $request->get( 'event_invitation_user_id', [] ) ) ) {
			db::insert( "insert into event_invitation (event_id, email, accept, created_at, updated_at, user_id) select {$event->id}, email, 0, now(), now(), ".Auth()->user()->id." from users where id in (" . implode( ', ', $request->get( 'event_invitation_user_id' ) ) . ")" );
                        foreach ($request->get( 'event_invitation_user_id' ) as $event_invitation_user_id)
                        {
                            
                            $user = User::find($event_invitation_user_id);
                            Mail::to($user->email)->send(new NotifyInvitation($event->toArray()));
                        }
		}

		$event->save();

		$user = User::find(auth()->id());
		switch ($event->type) {
			case Event::TYPE_EVENT:
				$user->number_of_events--;
				break;

			case Event::TYPE_ACTIVITY:
				$user->number_of_activity--;
				break;

			case Event::TYPE_SERVICE:
				$user->number_of_services--;
				break;
		}
		$user->save();

		$balanceTransaction = new BalanceTransaction();

		$balanceTransaction->user_id = auth()->id();
		$balanceTransaction->user_package_id = null;
		$balanceTransaction->use_eas_id = $event->id;
		$balanceTransaction->purchase_date = now();
		$balanceTransaction->duration_date = now();
		$balanceTransaction->number_of_events = $user->number_of_events;
		$balanceTransaction->number_of_activity = $user->number_of_activity;
		$balanceTransaction->number_of_services = $user->number_of_services;
		$balanceTransaction->total = 0;

		$balanceTransaction->save();

		return $event->id;

	}
}