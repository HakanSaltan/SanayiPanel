<?php
use \Illuminate\Support\Collection;
use \Spatie\Permission\Models\Role;
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
			 'email'=>'admin@admin.com',
			 'password'=>'$2y$10$UhxeJDP3pw4nbVRMaVXTR.6Tp.5oyaEBHEQBoXjOvILIxLAsv44yi'
			],

			['name'=>'Musteri',
			 'email'=>'musteri@musteri.com',
			 'password'=>'$2y$10$UhxeJDP3pw4nbVRMaVXTR.6Tp.5oyaEBHEQBoXjOvILIxLAsv44yi'
			]


		];
		foreach ($user as $key=>$value){
			User::create($value);
		}
		/*
		DB::insert('insert into model_has_roles (role_id,model_type,model_id) values (?, ?, ?)', [1,"App\User",1]);
		DB::insert('insert into model_has_roles (role_id,model_type,model_id) values (?, ?, ?)', [2,"App\User", 2]);
		*/
	}
}


