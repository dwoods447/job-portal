<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Company;
use App\Job;
use App\Category;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(User::class, 150)->create();
        factory(Company::class, 150)->create();
        factory(Job::class, 10)->create();



		$categories = [
			'Technology',
			'Engineering',
			'Government',
			'Medical',
			'Construction',
			'Software'
		];

		foreach($categories as $category){
			Category::create([
					'cat_name' =>$category
			]);
		}

    }
}
