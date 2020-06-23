<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        for($i = 15;$i <= 20;$i++){
            for($j = 100;$j <= 130;$j++){
                $faker = \Faker\Factory::create();
                $n = new User();
                $n->nim = "$i"."2016"."$j";
                $n->nama = $faker->name;
                $n->email = $faker->email;
                $n->alamat = $faker->address;
                $n->pin = "111111";
                $n->jenis_kelamin = $j % 2 == 1 ? "L" : "P";
                $n->save();
            }
        }

        // $this->call(UsersTableSeeder::class);
    }
}
