<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Michael Jones',
            'email' => 'mjones@capitalradio.net.au',
            'email_verified_at' => now(),
            'password' => bcrypt('6DoTkkh%1fAI1r4*'), // 123123123
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'osky',
            'email' => 'support@oskyinteractive.com.au',
            'email_verified_at' => now(),
            'password' => bcrypt('@U5VB8DkqLJ@Cla7'), // 123123123
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
