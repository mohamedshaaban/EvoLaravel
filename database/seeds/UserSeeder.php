<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $faker = Faker::create();

	    foreach(range(1, 10) as $id){
		    DB::insert("insert into users(type, role_id, name, email, password, verified, country_id, remember_token, created_at) values (?, ?, ?, ?, ?, ?, 116, '', now())",
			    [1, 2, $faker->name, $faker->email, bcrypt('123456'), 1]);
	    }
    }
}
