<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class EventSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		$fakerEn = Faker::create();
		$fakerAr = Faker::create( 'ar_SA' );

		if ( is_null( \App\Models\HostsUsers::first() ) ) {
			db::insert( "INSERT INTO `hosts_users` (`user_id`, `company_name`, `email`, `website`, `starting_year`, `company_certificate`, `landline`, `mobile`, `whatsapp`, `work_from`, `work_to`, `break_from`, `break_to`, `created_at`, `updated_at`) VALUES (1, '', 'test@a.com', '', 2018, 2020, '', '', '', '', '', '1', '2', '2018-10-01 14:43:33', '2018-10-01 14:43:40')" );
		}


		foreach ( range( 1, 5 ) as $index ) {

			$type   = rand( 1, 3 ); // Event, Activity, Service
			$ageMin = rand( 15, 25 );
			$ageMax = $ageMin + rand( 3, 20 );

			$dateFrom = date( 'Y-m-d', strtotime( "+" . rand( 5, 15 ) . " day" ) );
			$dateTo   = date( 'Y-m-d', strtotime( $dateFrom . " +" . rand( 0, 3 ) . " day" ) );

			$timeFrom = rand( 8, 20 ) . ":00:00";
			$timeTo   = date( 'H', strtotime( $timeFrom . " +" . rand( 1, 4 ) . " hours" ) ) . ":00:00";

			$location = $fakerEn->company;
			$address  = $fakerEn->address;

			$cancellationDays = 0;

			if ( $cancellation = rand( 0, 1 ) ) {

				$datetimeNow  = new DateTime();
				$datetimeFrom = new DateTime( $dateFrom );
				$interval     = $datetimeNow->diff( $datetimeFrom );
				$diff         = $interval->format( '%a' );

				$cancellationDays = rand( 5 > $diff ? $diff : 5, $diff );
			}
			$fee = rand( 0, 1 ) ? rand( 1000, 100000 ) / 1000 : 0;

			$private    = rand( 0, 1 );
			$multiPrice = rand( 0, 1 );
			$groupPrice = rand( 0, 1 );


			$id = db::table( "event" )->insertGetId( [
				'type'              => $type,
				'main_type_id'      => db::raw( "(select id from main_type where event_type={$type} order by rand() limit 1)" ),
				'host_id'           => db::raw( "(select id from hosts_users order by rand() limit 1)" ),
				'title_en'          => $fakerEn->title,
				'title_ar'          => $fakerAr->title,
				'description_en'    => $fakerEn->text,
				'description_ar'    => $fakerAr->text,
				'category_id'       => db::raw( "(select id from category where category_id=0 order by rand() limit 1)" ),
				'age_from'          => $ageMin,
				'age_to'            => $ageMax,
				'date_from'         => $dateFrom,
				'date_to'           => $dateTo,
				'time_from'         => $timeFrom,
				'time_to'           => $timeTo,
				'location_name_en'  => $location,
				'location_name_ar'  => $location,
				'address_lat'       => $fakerEn->latitude,
				'address_long'      => $fakerEn->longitude,
				'address_text'      => $address,
				'address_type'      => db::raw( "(select id from address_type order by rand() limit 1)" ),
				'address_city'      => db::raw( "(select id from city order by rand() limit 1)" ),
				'address_block'     => '',
				'address_street'    => $fakerEn->streetName,
				'address_avenue'    => '',
				'address_building'  => $fakerEn->buildingNumber,
				'address_floor'     => rand( 1, 5 ),
				'private_event'     => $private,
				'cancellation'      => $cancellation,
				'cancellation_days' => $cancellationDays,
				'capacity'          => rand( 10, 40 ),
				'fee'               => $fee,
				'multi_price'       => $multiPrice,
				'group_price'       => $groupPrice,

				'break_from'           => 0,
				'break_to'             => 0,
				'gender'               => rand( 1, 3 ),
				'attendees_listing'    => rand( 0, 1 ),
				'seating_booking_type' => rand( 1, 2 ),
				'booking_per_user'     => rand( 1, 10 ),
				'qr_code'              => '',

				'published_at' => date( 'Y-m-d H:i:s' ),
				'created_at'   => date( 'Y-m-d H:i:s' )
			] );


			db::insert( "
insert into event_require_data (event_id, require_data_id, created_at, updated_at) 
select ?, id, now(), now() from require_data order by rand() limit ?
", [ $id, rand( 3, 8 ) ] );


			db::insert( "
insert into event_professional (event_id, professional_id, created_at, updated_at) 
select ?, id, now(), now() from added_professional where status=1 order by rand() limit ?
", [ $id, rand( 1, 4 ) ] );


			db::insert( "
insert into event_company (event_id, company_id, created_at, updated_at) 
select ?, id, now(), now() from added_company where status=1 order by rand() limit ?
", [ $id, rand( 1, 4 ) ] );


			db::insert( "
insert into event_sponsor (event_id, sponsor_id, created_at, updated_at) 
select ?, id, now(), now() from added_sponsor where status=1 order by rand() limit ?
", [ $id, rand( 0, 3 ) ] );

			if ( $private ) {
				foreach ( range( 1, rand( 3, 5 ) ) as $index ) {
					db::insert( "
insert into event_invitation (event_id, email, accept, created_at, updated_at)
values (?, ?, 0, now(), now())
", [ $id, $fakerEn->email ] );
				}
			}

			if ( $multiPrice ) {
				foreach ( range( 1, rand( 2, 4 ) ) as $index ) {
					db::insert( "
insert into event_multiple_price 
(event_id, name_en, name_ar, cost, created_at, updated_at)
values (?, ?, ?, ?, now(), now())
", [ $id, "level " . $index, "level " . $index, $fee + 10 * $index ] );
				}

				foreach ( range( 1, rand( min( $fee, 2 ), min( $fee, 4 ) ) ) as $index ) {
					db::insert( "
insert into event_group_price 
(event_id, price_type_id, ticket_no, price, created_at, updated_at)
values (?, (select id from event_multiple_price where event_id=? order by rand() limit 1), ?, ?, now(), now())
", [ $id, $id, $index * 5, ( ( $fee - $index ) < 1 ? ( $fee - $index ) : 1 ) * $index ] );
				}
			}

		}
	}
}
