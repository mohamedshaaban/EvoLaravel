<?php

namespace App\Console\Commands;

use App\Models\Booking;
use Illuminate\Console\Command;

class DeletePendingBooking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'booking:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete booking over 5 minutes pending';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	\DB::delete('delete from attendees where booking_id in (select id from booking where status =? and TIME_TO_SEC(TIMEDIFF(now(), `created_at`))/60>5)',
		    [Booking::STATUS_PENDING]);

        \DB::delete('delete from booking where status =? and TIME_TO_SEC(TIMEDIFF(now(), `created_at`))/60>5',
		    [Booking::STATUS_PENDING]);

        $this->info('Pending Orders have deleted');

    }
}
