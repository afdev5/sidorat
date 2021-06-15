<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
        	[
        	 'name' => 'Administrator',
             'email' => 'admin@sidorat.com',
             'password' => bcrypt('kpTIUNIMA'),
             'level' => '0',
            ]
        ];

        DB::table('users')->insert($users);
    }
}
