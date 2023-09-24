<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections = array(
        	[
				'name' => 'Dashboard',
				'image' => 'fa fa-home',
				'sequence' => 1,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			],
			[
				'name' => 'My Profile',
				'image' => 'fa fa-user',
				'sequence' => 2,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			],
        	[
				'name' => 'Users',
				'image' => 'fa fa-users',
				'sequence' => 3,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			],
        	[
				'name' => 'Call rates',
				'image' => 'fa fa-money',
				'sequence' => 4,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			],
        	[
				'name' => 'National Numbers',
				'image' => 'fa fa-phone',
				'sequence' => 5,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			],
        	[
				'name' => 'Card Orders',
				'image' => 'fa fa-shopping-cart',
				'sequence' => 6,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			],
        	[
				'name' => 'Content',
				'image' => 'fa fa-file-text',
				'sequence' => 7,
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			],
        );

        foreach($sections as $section){
	        DB::table('sections')->insert($section);
		}
    }
}
