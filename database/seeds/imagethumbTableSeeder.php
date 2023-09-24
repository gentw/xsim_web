<?php

use Illuminate\Database\Seeder;

class imagethumbTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $thumbs = array (
            [
                'height'=>70,
                'width'=>70,
                'default_image'=>'images/default_profile.jpg',
            ],
        	[
        		'height'=>200,
        		'width'=>200,
        		'default_image'=>'images/default_profile.jpg',
        	],
        );

		$db = DB::table('imagethumb')->insert($thumbs);
    }
}
