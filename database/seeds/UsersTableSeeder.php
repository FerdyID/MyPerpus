<?php

use Illuminate\Database\Seeder;
use App\Domain\Entities\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'id'  			=> 1,
                'name'  			=> 'Admin',
                'email' 			=> 'admin@gmail.com',
                'password'		=> bcrypt('qwerty'),
                'gambar'			=> NULL,
                'level'			=> 'admin',
                'remember_token'	=> NULL,
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now()
            ],
            [
                'id'  			=> 2,
                'name'  			=> 'User',
                'email' 			=> 'user@gmail.com',
                'password'		=> bcrypt('qwerty'),
                'gambar'			=> NULL,
                'level'			=> 'user',
                'remember_token'	=> NULL,
                'created_at'      => Carbon::now(),
                'updated_at'      => Carbon::now()
            ]
        ]);
    }
}
