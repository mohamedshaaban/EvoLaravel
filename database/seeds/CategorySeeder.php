<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
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

	    $mainCategoryNo = 5;
	    $maxSubCategoryNo = 8;

	    foreach(range(1, $mainCategoryNo) as $id){
		    DB::insert("insert into category (id, name_en, name_ar, category_id, created_at) values (?, ?, ?, ?, now()) on duplicate key update name_en = values(name_en), name_ar = values(`name_ar`), category_id = values(`category_id`), updated_at=now()",
			    [$id, $fakerEn->words(2, true), $fakerAr->words(2, true), 0, 0]);
	    }

	    $newID=3;
	    foreach(range(1, $mainCategoryNo) as $id){
		    foreach(range(1, rand(2,$maxSubCategoryNo)) as $subId) {
		    	$newID++;
			    DB::insert("insert into category (id, name_en, name_ar, category_id, created_at) values (?, ?, ?, ?, now()) on duplicate key update name_en = values(name_en), name_ar = values(`name_ar`), category_id = values(`category_id`), updated_at=now()",
				    [$newID, $fakerEn->words(2, true), $fakerAr->words(2, true), $id]);
		    }
	    }

    }
}
