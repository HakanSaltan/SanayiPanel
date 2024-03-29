<?php

namespace App\Http\Controllers;
use App\Arac;
use App\qrOkutulan;
use Illuminate\Http\Request;

class AracController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    public function detay($plaka=0,Request $request)
    {
        // $token = $request->header('Api-Key');

        // if(!$token)
        //     return json_encode([
        //         "sonuc" => false,
        //         "mesaj" => "Giriş yapılamadı!"
        //     ]);

        $arac = Arac::where('plaka', '=',$plaka)->get();
        $qrOkutulan = new qrOkutulan();
        $qrOkutulan->arac_id = $arac[0]->id; 
        $qrOkutulan->save();

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
    
    public function aracDetay($plaka=0)
    {
        $aracdetay = Arac::where('plaka', '=',$plaka)->first();
        return view('arac/arac-detay')->with('aracdetay', $aracdetay);
    }
    public function plakaKontrol(Request $request)
    { 
        
        $req = file_get_contents("php://input");
        $req = json_decode($req, true);
        
        $plaka =  $req['plaka'];
        $aracSayi = Arac::where('plaka', '=',$plaka)->count();
        if($aracSayi > 0){
            $sonuc = $this->sonuc(true);

        }else{

            return $this->sonuc(false);

        }
        return $sonuc;
    }
    

}
