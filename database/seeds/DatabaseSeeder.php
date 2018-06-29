<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	factory(App\Qualification::class, 5)->create()->each(function ($q){
    		$cohort = new App\Cohort(['start_year' => 2017, 'exam_year' => 2017+$q->duration]);
    		$q->cohorts()->save($cohort);
    		$cohort = new App\Cohort(['start_year' => 2018, 'exam_year' => 2018+$q->duration]);
    		$q->cohorts()->save($cohort);
    	});
    }
}
