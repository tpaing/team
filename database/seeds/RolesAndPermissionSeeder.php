<?php

use Illuminate\Database\Seeder;
use App\Teams\Roles;
use App\Role;
use App\Permission;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Roles::$roles;

        foreach ($roles as $role => $data) {
        	$role = Role::firstOrCreate(['name' => $role]);

        foreach ($data['permissions'] as $permission) {
        		Permission::firstOrCreate(['name' => $permission]);

        		$role->attachPermission($permission);
        	}	
        }
    }
}
