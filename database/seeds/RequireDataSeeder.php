<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class RequireDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$sql = <<<SQL
    	insert into require_data (id, name_en, name_ar, created_at) values
  (1, 'Marital Status', 'Marital Status', now()),
  (2, 'Civil ID Number', 'Civil ID Number', now()),
  (3, 'Passport Number', 'Passport Number', now()),
  (4, 'Passport Copy', 'Passport Copy', now()),
  (5, 'Bibendum', 'Bibendum', now()),
  (6, 'Nulla Tempus', 'Nulla Tempus', now()),
  (7, 'Quisque Commodo', 'Quisque Commodo', now()),
  (8, 'Scelerisque', 'Scelerisque', now()),
  (9, 'Quisque', 'Quisque', now()),
  (10, 'Curabitur', 'Curabitur', now()),
  (11, 'Finibus Sit', 'Finibus Sit', now()),
  (12, 'Sed Euismod', 'Sed Euismod', now()),
  (13, 'Imterdum Libero', 'Imterdum Libero', now()),
  (14, 'Scelerisque', 'Scelerisque', now()),
  (15, 'Bibendum', 'Bibendum', now()),
  (16, 'Etiam Fermentu', 'Etiam Fermentu', now()),
  (17, 'Consectetur', 'Consectetur', now()),
  (18, 'Curabitur', 'Curabitur', now()),
  (19, 'Vulputate Turpis', 'Vulputate Turpis', now()),
  (20, 'Curabituer', 'Curabituer', now())
on duplicate key update name_en = values(name_en), name_ar = values(`name_ar`), updated_at=now()
SQL;

	    DB::insert($sql);
    }
}
