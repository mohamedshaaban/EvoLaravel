<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AddedCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $fakerEn = Faker::create();
	    $fakerAr = Faker::create('ar_SA');

	    $noImage = public_path('uploads/noimage.png');

	    foreach(range(1, 10) as $id){
		    DB::insert("insert into added_company(name_en, name_ar, img, status, added_by, created_at) values (?, ?, ?, ?, (select id from users order by rand() limit 1), now())",
			    [$fakerEn->company, $fakerAr->company, $noImage, 1]);
	    }
    }
}
