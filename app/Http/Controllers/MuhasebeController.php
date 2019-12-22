<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Islemler;
use App\islemHizmetleri;
use App\Arac;
use App\Fatura;
use App\Hizmetler;
use App\Musteri;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class MuhasebeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function fatura($fatura)
    {
        $kullanici = Musteri::where('user_id', '=',Auth::user()->id)->get();
        $faturabilgi = Fatura::where('fkod','=', $fatura)->get();
        return view('muhasebe/fatura', ['kullanici' => $kullanici[0]],['fatura'=>$faturabilgi[0]]);
    }

    public function faturaOlustur(Request $request)
    {   DB::beginTransaction();
        $bilgi = Islemler::where('id', '=', $request->islem_id)->first();
        $hizmetler = islemHizmetleri::where('islem_id', '=', $request->islem_id)->get();
        $toplam_fiyat = 0;
        foreach($hizmetler as $hizmet){
            $toplam_fiyat = $toplam_fiyat + $this->kdv_ekle($hizmet->hizmet_fiyat,$hizmet->hizmet_oran);
        }
        $fatura = new Fatura;
        $fatura->fkod = $request->fatura_no;
        $fatura->islem_id = $request->islem_id;
        $fatura->musteri_id = Auth::user()->id;
        $fatura->arac_id = $bilgi->arac_id;
        $fatura->toplamUcret = $toplam_fiyat;
        $fatura->save();
        DB::commit();
        return redirect()->back();
    }

    public function kdv_ekle($tutar,$oran){
        $kdv = $tutar * ($oran / 100);
        $ytutar = $tutar + $kdv;
        return $ytutar;
    }

    public function kdv_cikar($tutar,$oran){
        $ytutar = $tutar / (1 + ($oran/100));
        return $ytutar;
    }

    public function hizmet($arac_id)
    {
        // $tarih= new Carbon();
        $kullanici = Musteri::where('user_id', '=', Auth::user()->id)->get();
        $arac_bilgi = Arac::where('id','=', $arac_id)->get();
        $hizmetler = Hizmetler::all();
        return view('muhasebe/hizmet', ['kullanici' => htmlspecialchars_decode($kullanici), "hizmetler" => $hizmetler], ['arac' => $arac_bilgi[0]]);
    }

    public function hizmetEkle()
    {
        $post = json_decode(file_get_contents("php://input"), true);

        if(count($post["yapilan_hizmetler"]) < 1) return [false];

        $faturaOlusturulsun = $post["fatura"];

        DB::beginTransaction();

        $islemModel = new Islemler;
        
        $islemModel->user_id = Auth::user()->id;
        $islemModel->arac_id = $post["arac_id"];
        $islemModel->musteri_id = $post["musteri_id"];
        $islemModel->toplam_fiyat = $post["hizmet_fiyat"];
        $islemModel->kdv = $post["hizmet_kdv"];

        $islemModel->kar_miktari = 0;

        foreach($post["yapilan_hizmetler"] as $hizmet)
        {
            if(!$hizmet["kar"])
                continue;

            $islemModel->kar_miktari += floatval($hizmet["fiyat"]);
        }

        if(!$islemModel->save())
        {
            DB::rollBack();
            return json_encode([
                "sonuc" => false,
                "hataKodu" => "he-1"
            ]);
        }

        foreach($post["yapilan_hizmetler"] as $hizmet)
        {
            if($hizmet["yeniHizmet"])
            {
                $hizmetModel = new Hizmetler;

                $hizmetModel->ad = $hizmet["model"];
                $hizmetModel->fiyat = $hizmet["fiyat"];

                $t = ["ç", "Ç", "ö", "Ö", "ğ", "Ğ", "ü", "Ü", "ş", "Ş", "İ", "ı"];
                $e = ["c", "C", "o", "O", "g", "G", "u", "U", "s", "S", "I", "i"];

                $hizmetModel->hkod = str_replace($t, $e, mb_strtoupper(str_replace(" ", "_", $hizmetModel->ad), "UTF-8"));

                /** KOD KONTROL */
                    do
                    {
                        $durum = true;
                        $hizmetKontrol = DB::table("hizmetler")->where("hkod", "=", $hizmetModel->hkod)->first();

                        if(isset($hizmetKontrol->hkod) && $hizmetKontrol->hkod)
                        {
                            $durum = false;

                            $hizmetModel->hkod = $hizmetModel->hkod . "_" . mb_strtoupper(uniqid(), "UTF-8");
                        }
                    }
                    while(!$durum);
                /** # KOD KONTROL # */

                if(!$hizmetModel->save())
                {
                    DB::rollBack();
                    return json_encode([
                        "sonuc" => false,
                        "hataKodu" => "he-3"
                    ]);
                }

                $hizmetId = $hizmetModel->id;
            }
            else
            {
                $hizmetId = $hizmet["id"];
            }

            $islemHizmetleriModel = new islemHizmetleri;

            $islemHizmetleriModel->islem_id = $islemModel->id;
            $islemHizmetleriModel->kar = $hizmet["kar"];
            $islemHizmetleriModel->adet = $hizmet["adet"] ?? 1;
            $islemHizmetleriModel->hizmet_fiyat = $hizmet["fiyat"];
            $islemHizmetleriModel->hizmet_id = $hizmetId;

            if(!$islemHizmetleriModel->save())
            {
                DB::rollBack();
                return json_encode([
                    "sonuc" => false,
                    "hataKodu" => "he-2"
                ]);
            }
        }

        if($faturaOlusturulsun)
        {
            $sonFaturaKodu = Fatura::where("id", "<>", "NULL")
                                ->orderBy('created_at', 'desc')
                                ->take(1)
                                ->get();

            if(isset($sonFaturaKodu[0]->fkod))
                $fkod = $sonFaturaKodu[0]->fkod;
            else
                $fkod = 1;

            $toplam_fiyat = $post["hizmet_fiyat"];

            $faturaModel = new Fatura();

            $faturaModel->fkod = $fkod;
            $faturaModel->islem_id = $islemModel->id;
            $faturaModel->musteri_id = $post["musteri_id"];
            $faturaModel->arac_id = $post["arac_id"];
            $faturaModel->toplamUcret = $toplam_fiyat;

            if(!$faturaModel->save())
            {
                DB::rollBack();
                return json_encode([
                    "sonuc" => false,
                    "hataKodu" => "he-3"
                ]);
            }
        }

        DB::commit();

        return json_encode([
            "sonuc" => true,
            "veriler" => $faturaModel
        ]);
    }
}
