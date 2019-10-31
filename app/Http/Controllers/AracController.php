<?php

namespace App\Http\Controllers;
use App\Arac;
use Illuminate\Http\Request;

class AracController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    public function aracDetay($plaka=0,Request $request)
    {
        // $token = $request->header('Api-Key');

        // if(!$token)
        //     return json_encode([
        //         "sonuc" => false,
        //         "mesaj" => "Giriş yapılamadı!"
        //     ]);

        $arac = Arac::where('plaka', '=',$plaka)->get();

        if(count($arac))
        {
            $arac = $arac[0];
            return json_encode([
                "veriler" => [
                    "hizmet_bilgileri" => $arac->Hizmet,
                    "arac_bilgileri" => $arac,
                ],
                "sonuc" => true
            ]);
        }
        else
            return json_encode([
                "sonuc" => false
            ]);
       
    }
        

}
