<?php

use Illuminate\Database\Seeder;

class Job_InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Job_Interest::class, 30)->create();
    }
}
