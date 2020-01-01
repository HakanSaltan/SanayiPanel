<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use \Illuminate\Support\Collection;
use \Spatie\Permission\Models\Role;
use \Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Musteri;
use App\Arac;
use App\AracModel;
use App\Marka;
use App\userAyar;
class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function firmaKayit()
	{
        DB::beginTransaction();
        $ayar = userAyar::where('user_id', '=',Auth::user()->id)->get();
        $post = $_POST;
        $dosyalar = $_FILES;
        
        if (isset($dosyalar["firma_logo"]) && $dosyalar["firma_logo"]["error"] == UPLOAD_ERR_OK) {
            $resimUrl = $this->resimKayit($dosyalar);
            if(!$resimUrl["sonuc"])
            {
                return ["sonuc" => false];
            }

            $post['firma_logo'] = [
                "yol" => $resimUrl["yol"],
                "eskiAd" => $resimUrl["eskiDosyaIsmi"]
            ];

        }

        $post = json_encode($post);
        if(!$ayar){
            if($post){
                $ayar = new userAyar();
                $ayar->user_id = Auth::user()->id;
                $ayar->ayarJSON = $post;

                if(!$ayar->save())
                {
                    $sonuc = $this->sonuc(false);
                }

                $sonuc = $this->sonuc(true);
            }
        }else if($post){
                $ayar = userAyar::where("user_id",Auth::user()->id)->delete();
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
            DB::commit();
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
        
        $plaka =  $req['plaka'];
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
    public function aracEkle(Request $request)
	{
        DB::beginTransaction();
        $req = file_get_contents("php://input");
        $req = json_decode($req, true);

        if(!isset($req["plaka"]) || !$req["plaka"])
            return $this->sonuc(false);

        $plaka= $req['plaka'];
        $km =  trim($req['km']);
        $sase =  trim($req['sase']);
        $marka =  trim($req['marka']);
        $aracModel =  trim($req['aracModel']);
        $qrCode = "https://chart.googleapis.com/chart?cht=qr&chs=512x512&chl=" . $plaka;

        if($plaka){
                
                $arac = new Arac();
                $arac->musteri_id ="0";
                $arac->user_id = Auth::user()->id;
                $arac->plaka = $plaka;
                $arac->marka = $marka;
                $arac->sase = $sase;
                $arac->km = $km;
                $arac->model = $aracModel;
                $arac->qrCode = $qrCode;
                $arac->save();

            $sonuc = $this->sonuc(true);
                        
        }else{
            $sonuc = $this->sonuc(false);
        }
        DB::commit();
        return $sonuc;
    }
    public function aracSil(Request $request)
    {
        $req = file_get_contents("php://input");
        $req = json_decode($req, true);

        if(isset($req["aid"])){
            
            $id =  trim($req['aid']);
            Arac::find($id)->delete();
            $sonuc = $this->sonuc(true);

        }else{

            return $this->sonuc(false);

        }
    }
    public function musteriGuncelle(Request $request)
	{
        DB::beginTransaction();
        $req = file_get_contents("php://input");
        $req = json_decode($req, true);

        if(!isset($req["telefon"]) || !$req["telefon"])
            return $this->sonuc(false);

        $id =  trim($req['kid']);
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
    public function musteriEkle(Request $request)
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
                
                $musteri = new Musteri();
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
    public function musteriSil(Request $request)
    {
        $req = file_get_contents("php://input");
        $req = json_decode($req, true);

        if(isset($req["kid"])){
            
            $id =  trim($req['kid']);
            Musteri::find($id)->delete();
            $sonuc = $this->sonuc(true);

        }else{

            return $this->sonuc(false);

        }
    }

    public function musteriKayit(Request $request)
	{
        DB::beginTransaction();
        $req = file_get_contents("php://input");
        $req = json_decode($req, true);

        if(!isset($req["plaka"], $req["telefon"]) || !$req["plaka"] || !$req["telefon"])
            return $this->sonuc(false);

        
        $plaka= $req['plaka'];
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

                $musteriSonId = Musteri::latest()->first();

                $araba = new Arac();
                $araba->plaka = $plaka;
                $araba->musteri_id = $musteriSonId->id;
                $araba->user_id = Auth::user()->id;
                $araba->qrCode = $qrCode;
                $araba->save();

            $sonuc = $this->sonuc(true, [
                "location" => "/araclarim"
            ]);
                        
        }else{
            $sonuc = $this->sonuc(false);
        }
        DB::commit();
        return $sonuc;
    }
    
    public function musteriArac(Request $request)
	{
        DB::beginTransaction();
        $req = file_get_contents("php://input");
        $req = json_decode($req, true);

        $mid =  trim($req['mid']);
        $arac_id =  trim($req['arac_id']);
        

        if($mid){
                
                $arac = Arac::find($arac_id);
                $arac->musteri_id = $mid;
                $arac->save();

            $sonuc = $this->sonuc(true);
                        
        }else{
            $sonuc = $this->sonuc(false);
        }
        DB::commit();
        return $sonuc;
    }

    
    

}
