<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function rastgele(){
		$karakterler = "abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPRSTUVYZ";
		$karakter_sayi = strlen($karakterler);
		$sifre_ver=0;
		for ($ras = 0; $ras < 6; $ras++) {
			$rakam_ver = rand(0,$karakter_sayi-1);
			$sifre_ver = $sifre_ver.$karakterler[$rakam_ver];
		}

		return $sifre_ver;




	}
}
