<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
		$user=[

			['name'=>'Admin',
			 'email'=>'admin',
			 'password'=>'$2y$10$UhxeJDP3pw4nbVRMaVXTR.6Tp.5oyaEBHEQBoXjOvILIxLAsv44yi'
			],

			['name'=>'User',
			 'email'=>'user',
			 'password'=>'$2y$10$UhxeJDP3pw4nbVRMaVXTR.6Tp.5oyaEBHEQBoXjOvILIxLAsv44yi'
			]


		];
		foreach ($user as $key=>$value){
			User::create($value);
		}
	}
}


