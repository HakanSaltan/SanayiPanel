<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sonuc($sonuc, $parametreler=[]){
        return json_encode([
            "sonuc" => $sonuc,
            "parametreler" => $parametreler
        ]);
    }

    public function plakaSifrele($plaka) {
        return str_replace(" ", "_", preg_replace('!\s+!', ' ', trim($plaka)));
    }
      
    public function plakaCoz($plaka) {
    return str_replace("_", " ", $plaka);
	}
	
    public function rastgele(){
		return uniqid();
	}
	
	public function resimKayit($Resim)
    {
        $uretilen = $this->rastgele();
       
        $uploads_dir = 'uploads/';
        $tmp_name = $Resim["firma_logo"]["tmp_name"];
        $name = $Resim["firma_logo"]["name"];
        $sonuc = move_uploaded_file($tmp_name, "$uploads_dir/$uretilen");

        if($sonuc == true)
        {
            $islemlerSonucu = [
                "sonuc" => true,
                "eskiDosyaIsmi" => $name,
                "yol" => $uploads_dir . "/" . $uretilen
            ];
        }
        else
        {
            $islemlerSonucu = [
                "sonuc" => false,
            ];
        }
        return $islemlerSonucu;

    }
}
