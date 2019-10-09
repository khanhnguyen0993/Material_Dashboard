<?php

use Illuminate\Database\Seeder;
use App\Competition;

class CompetitionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $competitions = 5;
      factory(Competition::class, $competitions)->create();
    }
}
