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

        DB::beginTransaction();
        $islemModel = new Islemler;

        $islemModel->arac_id = $post["arac_id"];
        $islemModel->musteri_id = $post["musteri_id"];

        if(!$islemModel->save())
        {
            DB::rollBack();
            return json_encode([
                "sonuc" => false,
                "hataKodu" => "he-1"
            ]);
        }

        $toplam_fiyat = $post["hizmet_fiyat"];

        foreach($post["yapilan_hizmetler"] as $hizmet)
        {
            $islemHizmetleriModel = new islemHizmetleri;

            $islemHizmetleriModel->islem_id = $islemModel->id;
            $islemHizmetleriModel->hizmet_kdv = $post["hizmet_kdv"];
            $islemHizmetleriModel->adet = 1;
            $islemHizmetleriModel->hizmet_fiyat = $hizmet["fiyat"];
            $islemHizmetleriModel->hizmet_id = $hizmet["id"];

            if(!$islemHizmetleriModel->save())
            {
                DB::rollBack();
                return json_encode([
                    "sonuc" => false,
                    "hataKodu" => "he-2"
                ]);
            }
        }


        DB::commit();

        return json_encode([
            "sonuc" => true,
            "veriler" => $islemModel->id
        ]);
    }
}
