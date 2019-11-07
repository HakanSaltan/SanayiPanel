<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Musteri;
use App\Arac;
use App\AracModel;
use App\Marka;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Collection;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    
    public function aracGuncelle($id,$mid,Request $request)
	{
        DB::beginTransaction();
        $req = file_get_contents("php://input");
        $req = json_decode($req, true);

        if(!isset($req["plaka"]) || !$req["plaka"])
            return $this->sonuc(false);
        
        $plaka =  plakaSifrele($req['plaka']);
        $km =  trim($req['km']);
        $marka =  trim($req['marka']);
        $aracModel =  trim($req['aracModel']);
        $qrCode =  trim($req['qrCode']);

        if($plaka){
                
                $arac = Arac::find($id);
                $arac->musteri_id = $mid;
                $arac->plaka = $plaka;
                $arac->km = $km;
                $arac->marka = $marka;
                $arac->aracModel = $aracModel;
                $arac->qrCode = $qrCode;
                $arac->save();

            $sonuc = $this->sonuc(true);
                        
        }else{
            $sonuc = $this->sonuc(false);
        }
        DB::commit();
        return $sonuc;
    }
    public function aracSil($id)
    {
        Arac::find($id)->delete();
        return Redirect::back()->with('success', ['Araç Başarıyla Silinmiştir']);;
    }
    public function musteriGuncelle($id,Request $request)
	{
        DB::beginTransaction();
        $req = file_get_contents("php://input");
        $req = json_decode($req, true);

        if(!isset($req["telefon"]) || !$req["telefon"])
            return $this->sonuc(false);
        
        $telefon =  trim($req['telefon']);
        $isimSoyisim =  trim($req['isimSoyisim']);
        $tc =  trim($req['tc']);
        $adres =  trim($req['adres']);

        if($telefon){
                
                $musteri = Musteri::find($id);
                $musteri->user_id = Auth::user()->id;
                $musteri->telefon = $telefon;
                $musteri->tc = $tc;
                $musteri->isimSoyisim = $isimSoyisim;
                $musteri->adres = $adres;
                $musteri->save();

            $sonuc = $this->sonuc(true);
                        
        }else{
            $sonuc = $this->sonuc(false);
        }
        DB::commit();
        return $sonuc;
    }
    public function musteriSil($id)
    {
        Musteri::find($id)->delete();

        return Redirect::back()->with('success', ['Müşteri Başarıyla Silinmiştir']);;
    }

    public function musteriKayit(Request $request)
	{
        DB::beginTransaction();
        $req = file_get_contents("php://input");
        $req = json_decode($req, true);

        if(!isset($req["plaka"], $req["telefon"]) || !$req["plaka"] || !$req["telefon"])
            return $this->sonuc(false);

        
        $plaka= $this->plakaSifrele($req['plaka']);
        $telefon =  trim($req['telefon']);
        $isimSoyisim =  trim($req['isimSoyisim']);
        $tc =  trim($req['tc']);
        $adres =  trim($req['adres']);
        $qrCode = "https://chart.googleapis.com/chart?cht=qr&chs=512x512&chl=" . $plaka;

        if($telefon && $isimSoyisim){
                
                $musteri = new Musteri();
                $musteri->user_id = Auth::user()->id;
                $musteri->telefon = $telefon;
                $musteri->tc = $tc;
                $musteri->isimSoyisim = $isimSoyisim;
                $musteri->adres = $adres;
                $musteri->save();

                $musteriSonId = $musteri->id;

                $araba = new Arac();
                $araba->plaka = $plaka;
                $araba->musteri_id = $musteriSonId;
                $araba->qrCode = $qrCode;
                $araba->save();


/*              Musteri::find($musteriSonId)->first()->assignRole('musteri');
                $kullanici = Auth::user();
                DB::insert('insert into musteri_user (user_id, musteri_id) values (?, ?)', [
                    $kullanici->id,
                    $musteriSonId
                ]);

*/
            $sonuc = $this->sonuc(true);
                        
        }else{
            $sonuc = $this->sonuc(false);
        }
        DB::commit();
        return $sonuc;
    }
    

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

    public function aracDetay($id=0)
    {
        $aracdetay = Arac::find($id)->first();
        
        return view('arac/arac-detay')->with('aracdetay', $aracdetay);
        
    }
    

}
