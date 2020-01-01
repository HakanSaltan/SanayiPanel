<?php
use \Illuminate\Support\Collection;
use \Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

use App\User;
use App\userAyar;
use Illuminate\Support\Facades\DB;

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
			],

			['name'=>'Deneme',
			 'email'=>'deneme@deneme.com',
			 'password'=>'$2y$10$UhxeJDP3pw4nbVRMaVXTR.6Tp.5oyaEBHEQBoXjOvILIxLAsv44yi'
			]

		];
		$userJson=[

			['user_id'=>'1',
			 'ayarJson'=>'{"id":"1","firma_adi":"Kodgarj","firma_sahibi":"Kodgarj","firma_telefon":"05453601002","firma_adresi":"Kurtulu\u015f, Ey\u00fcp Sk. \u00d6zel Neva Fen ve Anadolu Lisesi)","firma_logo":{"yol":"uploads\/5e0bd0f009551","eskiAd":"kodgaraj.png"}}	NULL'
			]

		];
		foreach ($user as $key=>$value){
			User::create($value)->assignRole('admin');
		}
		foreach ($userJson as $key=>$value){
			userAyar::create($value);
		}
		
		
	}
}


