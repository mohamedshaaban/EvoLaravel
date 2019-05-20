<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

	    $sql = <<<SQL
    	insert into city (id, name_en, name_ar, country_id, created_at) values
  (1, "Kuwait City", "مدينة الكويت", 116, now()),
  (2, "Dasman", "دسمان", 116, now()),
  (3, "Sharq", "شرق", 116, now()),
  (4, "Mirgab", "المرقاب", 116, now()),
  (5, "Jibla", "جبلة", 116, now()),
  (6, "Dasma", "الدسمة", 116, now()),
  (7, "Da'iya", "الدعية", 116, now()),
  (8, "Sawabir", "الصوابر", 116, now()),
  (9, "Salhiya", "الصالحية", 116, now()),
  (10,"Bneid il-Gar", "بنيد القار", 116, now()),
  (11,"Kaifan", "كيفان", 116, now()),
  (12,"Mansuriya", "المنصورية", 116, now()),
  (13,"Abdullah as-Salim suburb", "ضاحية عبد الله السالم", 116, now()),
  (14,"Nuzha", "النزهة", 116, now()),
  (15,"Faiha", "الفيحاء", 116, now()),
  (16,"Shamiya", "الشامية", 116, now()),
  (17,"Rawda", "الروضة", 116, now()),
  (18,"Adiliya", "العديلية", 116, now()),
  (19,"Khaldiya", "الخالدية", 116, now()),
  (20,"Qadsiya", "القادسية", 116, now()),
  (21,"Qurtuba", "قرطبة", 116, now()),
  (22,"Surra", "السرة", 116, now()),
  (23,"Yarmuk", "اليرموك", 116, now()),
  (24,"Shuwaikh", "الشويخ", 116, now()),
  (25,"Rai", "الري", 116, now()),
  (26,"Ghirnata", "غرناطة", 116, now()),
  (27,"Sulaibikhat", "الصليبخات", 116, now()),
  (28,"Doha", "الدوحة", 116, now()),
  (29,"Nahdha", "النهضة", 116, now()),
  (30,"Jabir al-Ahmad City", "مدينة جابر الأحمد", 116, now()),
  (31,"Qairawan", "القيروان", 116, now())
on duplicate key update name_en = values(name_en), name_ar = values(`name_ar`), country_id = values(`country_id`), updated_at=now()
SQL;

	    DB::insert($sql);
    }
}
