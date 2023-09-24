<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            [
                'section_id'=>'Dashboard',
                'title'=>'Dashboard',
                'route'=>'admin.home.index',
                'image'=>'fa fa-home',
                'sequence'=>1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        	[
        		'section_id'=>'My Profile',
        		'title'=>'My Profile',
        		'route'=>'admin.profile.show',
        		'image'=>'fa fa-user',
        		'sequence'=>1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
        	],
            [
                'section_id'=>'Users',
                'title'=>'Users',
                'route'=>'admin.user.index',
                'image'=>'fa fa-users',
                'sequence'=>1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'section_id'=>'Call rates',
                'title'=>'Call rates',
                'route'=>'admin.rate.index',
                'image'=>'fa fa-money',
                'sequence'=>1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'section_id'=>'National Numbers',
                'title'=>'National Numbers',
                'route'=>'admin.number.index',
                'image'=>'fa fa-phone',
                'sequence'=>1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'section_id'=>'Card Orders',
                'title'=>'Card Orders',
                'route'=>'admin.order.index',
                'image'=>'fa fa-shopping-cart',
                'sequence'=>1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
        	[
        		'section_id'=>'Content',
        		'title'=>'Content',
        		'route'=>'admin.content.index',
        		'image'=>'fa fa-file-text',
        		'sequence'=>1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
        	],
        );

        foreach($roles as $role){
        	$section_id = DB::table('sections')
        						->where('name', '=', $role['section_id'])
        						->first()->id;

        	$role['section_id'] = ($section_id > 0 ? $section_id : 1);

        	DB::table('roles')->insert($role);
        }
    }
}
