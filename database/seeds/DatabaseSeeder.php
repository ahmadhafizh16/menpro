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
        $n = new User();
        $n->username = "admin";
        $n->password = bcrypt("admin");
        $n->name = "Admin";
        $n->email = "a@a.com";
        $n->save();

        // $this->call(UsersTableSeeder::class);
    }
}
