<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use App\Musteri;
use App\Arac;
use App\AracModel;
use App\Marka;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //auth()->user()->assignRole('super-admin');
        //auth()->user()->assignRole('musteri');
        
        if(auth()->user()->hasRole('super-admin')){
            return view('superadmin/home');
        } elseif(auth()->user()->hasRole('admin')){;
            $user_id = Auth::user()->id;
            
            $kullanici = User::where('id', '=', $user_id)->get();
            $toplamMusteri = Musteri::where('user_id', $user_id)->count();
            $toplamKayitliArac = DB::table('arac')
                ->join('musteri', 'arac.musteri_id', '=', 'musteri.id')
                ->leftJoin("users", "users.id", "=", "musteri.user_id")
                ->where("users.id", "=", $user_id)
                ->count();
            $toplamYapilanHizmet = DB::table('islemler')
                ->join('musteri', 'islemler.musteri_id', '=', 'musteri.id')
                ->leftJoin("users", "users.id", "=", "musteri.user_id")
                ->where("users.id", "=", $user_id)
                ->count();
            $toplamKar = DB::table('islemler')
                ->where("user_id", "=", $user_id)
                ->sum("kar_miktari");
            $toplamCiro = DB::table('islemler')
                ->where("user_id", "=", $user_id)
                ->sum("toplam_fiyat");
            $chartVerileri = DB::table("fatura")
                ->select('fkod', 'fatura.created_at as tarih', 'toplamUcret', 'kar_miktari')
                ->join('islemler', 'islemler.id', '=', 'fatura.islem_id')
                ->join('musteri', 'musteri.id', '=', 'islemler.musteri_id')
                ->leftJoin("users", "users.id", "=", "musteri.user_id")
                ->where("users.id", "=", $user_id)
                ->get();
            
            $aylar = [];
            foreach($chartVerileri as $veri)
            {
                $date = date_create($veri->tarih);
                $ay = date_format($date, 'm');
                
                if(!isset($aylar[$ay]))
                $aylar[$ay] = 0;
                
                $aylar[$ay] += floatval($veri->kar_miktari);
            }
            
            return view('admin/home')->with([
                'kullanici' => $kullanici,
                "toplamMusteri" => $toplamMusteri,
                "toplamKayitliArac" => $toplamKayitliArac,
                "toplamYapilanHizmet" => $toplamYapilanHizmet,
                "toplamKar" => $toplamKar,
                "toplamCiro" => $toplamCiro,
                "chartVerileri" => json_encode($aylar, JSON_FORCE_OBJECT)
            ]);
        }
    }
    public function profile()
    {
        $kullanici = User::where('id', '=',Auth::user()->id)->get();

        return view('admin/profile')->with('kullanici', $kullanici);
    }
    public function musterilerim()
    {
        $kullanicilar = Musteri::where('user_id', '=',Auth::user()->id)->get();


        return view('admin/musteriler')->with('kullanicilar', $kullanicilar);
    }
    public function araclarim()
    {
        
        $kullanici = Musteri::where('user_id', '=', Auth::user()->id)->get();
        $markalar = Marka::all();

        $donecek_dizi = [];
        if($_GET){
            $plaka = $_GET['plakaAra'];

            $kullanici->arac = Arac::where("plaka", "=", $plaka)->get();

            $donecek_dizi[] = $kullanici;
            // foreach($kullanici as $key => $kul)
            // {
            //     // $kul->Arac;
            //     $arac = $kul->Arac;
            //     echo "<pre>";
            //     print_r($kul);
            //     echo "</pre>";
            //     if($arac->plaka == $plaka)
            //         $donecek_dizi[$key] = $kul;
            //     // $donecek_dizi[$key]["araclar"] = $kul->Arac;
            // }
        }else{
            foreach($kullanici as $key => $kul)
            {
                $kul->Arac;
                $donecek_dizi[$key] = $kul;
                // $donecek_dizi[$key]["araclar"] = $kul->Arac;
            }
        }
        // echo "<pre>";
        // print_r(json_encode($donecek_dizi));
        // echo "</pre>";
        // return;

        return view('arac/araclar', [
            'kullanici' => $donecek_dizi,
            'markalar'=>$markalar
        ]);
        
    }
}
