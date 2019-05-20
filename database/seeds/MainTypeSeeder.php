<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	    $sql = <<<SQL
    	insert into main_type (id, name_en, name_ar, event_type, created_at) values
  (1, 'Exhibition/Fair', 'Exhibition/Fair', 1, now()),
  (2, 'Festival', 'Festival', 1, now()),
  (3, 'Conference', 'Conference', 1, now()),
  (4, 'Convention', 'Convention', 1, now()),
  (5, 'Summit', 'Summit', 1, now()),
  (6, 'Seminar', 'Seminar', 1, now()),
  (7, 'Show', 'Show', 1, now()),
  (8, 'Tour', 'Tour', 2, now()),
  (9, 'Meeting', 'Meeting', 2, now()),
  (10, 'Trip (Local)', 'Trip (Local)', 2, now()),
  (11, 'Trip (Abroad)', 'Trip (Abroad)', 2, now()),
  (12, 'Camp (Local)', 'Camp (Local)', 2, now()),
  (13, 'Meet & Greet', 'Meet & Greet', 2, now()),
  (14, 'Course', 'Course', 2, now()),
  (15, 'Program', 'Program', 2, now()),
  (16, 'Workshop', 'Workshop', 2, now()),
  (17, 'Appointment', 'Appointment', 3, now()),
  (18, 'Class', 'Class', 3, now())
on duplicate key update name_en = values(name_en), name_ar = values(`name_ar`), event_type=values(event_type), updated_at=now()
SQL;

	    DB::insert($sql);
    }
}
