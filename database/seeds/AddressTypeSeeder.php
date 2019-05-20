<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	    $sql = <<<SQL
    	insert into address_type (id, name_en, name_ar, created_at) values
  (1, 'Stage', 'مسرح', now()),
  (2, 'Hall', 'قاعة', now()),
  (3, 'Office', 'مكتب', now()),
  (4, 'Room', 'غرفة', now()),
  (5, 'Library', 'مكتبة', now()),
  (6, 'Building', 'مبنى', now())
on duplicate key update name_en = values(name_en), name_ar = values(`name_ar`), updated_at=now()
SQL;

	    DB::insert($sql);
    }
}
