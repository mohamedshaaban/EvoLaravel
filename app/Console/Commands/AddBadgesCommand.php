<?php

namespace App\Console\Commands;

use App\Models\Badges;
use App\User;
use Illuminate\Console\Command;

class AddBadgesCommand extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'badge:add';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Add badges to uses by existing criteria';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {

		foreach ( Badges::get() as $badge ) {

			if ( $badge->badge_type == Badges::BADGE_TYPE_TRANSACTIONS ) {
				$db = \DB::table( 'booking' )
				         ->select( 'user_id' )
				         ->selectRaw( $badge->id . ' as badge_id' )
				         ->whereNotNull( 'user_id' )
				         ->groupBy( 'user_id' )
				         ->havingRaw( 'count(*) between ? and ?', [
					         $badge->no_of_transactions_from,
					         $badge->no_of_transactions_to
				         ] );

				if ( $badge->user_type != User::ALL_USER_ROLE_ID ) {
					$db = $db->join( 'users', 'users.id', '=', 'booking.user_id' )
					         ->where( 'users.role_id', $badge->user_type );
				}
			} else {

				$db = \DB::table( 'event' )
				         ->select( 'host_id as user_id' )
				         ->selectRaw( $badge->id . ' as badge_id' )
				         ->whereNotNull( 'host_id' )
				         ->groupBy( 'host_id' )
				         ->havingRaw( 'count(*) between ? and ?', [ $badge->no_eas_from, $badge->no_eas_to ] );

				if ( $badge->include_rating ) {
					// TODO: Rating is mixed here
					$db = $db->join( 'event-reviews', 'event_id', '=', 'event.id' )
					         ->havingRaw( 'avg(rating) between ? and ?', [ $badge->rating_from, $badge->rating_to ] );
				}
			}

			$rows = $db->get();

			if(count($rows)){

				$inserts = [];

				foreach ($rows->toArray() as $row){
					$inserts[] = implode(', ', (array) $row);
				}

				\DB::insert(
					"insert ignore into user_badges (user_id, badge_id) values (".
					implode('), (', $inserts).")"
				);

				$this->info( 'Add Badges - '.$badge->id.' : '.$badge->name_en );
			}
	    }

	}
}
