<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use \Illuminate\Support\Collection;


class PermissionTableSeeder extends Seeder
{
   
	public function run()
	{
		// Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

		// create permissions
		Permission::create(['name' => 'okur']);
        Permission::create(['name' => 'duzenler']);
        Permission::create(['name' => 'siler']);
        Permission::create(['name' => 'gunceller']);
        Permission::create(['name' => 'gizli']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'musteri']);
        $role->givePermissionTo('okur');

        // or may be done by chaining
        $role = Role::create(['name' => 'admin'])
            ->givePermissionTo(['gunceller', 'siler','duzenler']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
	}
}

