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
    		$cohort = new App\Cohort(['start_year' => 2017, 'exam_year' => 2017+rand(1, 3), 'terms_per_year' => rand(2,4)]);
    		$q->cohorts()->save($cohort);
    		$cohort = new App\Cohort(['start_year' => 2018, 'exam_year' => 2018+rand(2, 4), 'terms_per_year' => rand(2,4)]);
            $cohort = new App\Cohort(['start_year' => 2019, 'exam_year' => 2019+rand(2, 4), 'terms_per_year' => rand(2,4)]);
    		$q->cohorts()->save($cohort);
    	});

        factory(App\Type::class, 6)->create()->each(function ($type){
            $type->courses()->save(factory(App\Course::class)->make());
            $type->courses()->save(factory(App\Course::class)->make());
        });
    }
}
