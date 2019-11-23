<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Musteri;
use App\Arac;
use App\AracModel;
use App\Marka;
use App\userAyar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Collection;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function firmaKayit()
	{
       

        $post = $_POST;
        $dosyalar = $_FILES;
        
        if ($dosyalar["firma_logo"]["error"] == UPLOAD_ERR_OK) {
            $resimUrl = $this->resimKayit($dosyalar);
            if(!$resimUrl["sonuc"])
            {
                return ["sonuc" => false];
            }

            $post['firma_logo'] = [
                "yol" => $resimUrl["yol"],
                "eskiAd" => $resimUrl["eskiDosyaIsmi"]
            ];

            $post = json_encode($post);
        }
            
        if($post){
            $ayar = new userAyar();
            $ayar->user_id = Auth::user()->id;
            $ayar->ayarJSON = $post;

            if(!$ayar->save())
            {
                $sonuc = $this->sonuc(false);
            }

            $sonuc = $this->sonuc(true);
        }else{
            $sonuc = $this->sonuc(false);
        }
        
        return $sonuc;
    }
    
    public function firmaGuncelle(Request $request, $id, Factory $cache)
    {
        
        $cache->forget('userAyar');
        
    }
    
    public function aracGuncelle(Request $request)
	{
        DB::beginTransaction();
        $req = file_get_contents("php://input");
        $req = json_decode($req, true);

        if(!isset($req["plaka"]) || !$req["plaka"])
            return $this->sonuc(false);
        
        $plaka =  $this->plakaSifrele($req['plaka']);
        $km =  trim($req['km']);
        $marka =  trim($req['marka']);
        $aracModel =  trim($req['aracModel']);
        $arac_id =  trim($req['arac_id']);
        $mid =  trim($req['mid']);

        if($plaka){
                
                $arac = Arac::find($arac_id);
                $arac->musteri_id = $mid;
                $arac->plaka = $plaka;
                $arac->km = $km;
                $arac->marka = $marka;
                $arac->model = $aracModel;
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
            $sonuc = $this->sonuc(true, [
                "location" => "/araclarim"
            ]);
                        
        }else{
            $sonuc = $this->sonuc(false);
        }
        DB::commit();
        return $sonuc;
    }
    


    
    

}
