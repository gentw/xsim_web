<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_users = array(
        	[
				'admin_id' => 1,
				'role_id' => 1,
				'permissions' => 'access',
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			],
        	[
				'admin_id' => 1,
				'role_id' => 2,
				'permissions' => 'access,view,edit',
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			],
        	[
				'admin_id' => 1,
				'role_id' => 3,
				'permissions' => 'access,view,add,edit,delete',
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			],
        	[
				'admin_id' => 1,
				'role_id' => 4,
				'permissions' => 'access,view,add,edit,delete',
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			],
        	[
				'admin_id' => 1,
				'role_id' => 5,
				'permissions' => 'access,view,add,edit,delete',
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			],
        	[
				'admin_id' => 1,
				'role_id' => 6,
				'permissions' => 'access,view,add,edit,delete',
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			],
        	[
				'admin_id' => 1,
				'role_id' => 7,
				'permissions' => 'access,edit',
				'created_at' => \Carbon\Carbon::now(),
				'updated_at' => \Carbon\Carbon::now(),
			],
        );

        foreach($role_users as $role_user){
	        DB::table('admin_role')->insert($role_user);
		}
    }
}
