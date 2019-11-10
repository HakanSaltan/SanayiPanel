<?php
use App\Hizmetler;
use Illuminate\Database\Seeder;

class HizmetlerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hizmet=[

			['hkod'=>'ISCILIK',
			 'ad'=>'İşçilik',
			 'fiyat'=>100
			],

			['hkod'=>'ISCILIK',
			 'ad'=>'İşçilik',
			 'fiyat'=>100
			]


		];
		foreach ($hizmet as $key=>$value){
			Hizmetler::create($value);
		}
    }
}
