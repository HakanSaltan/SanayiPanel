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
        //auth()->user()->assignRole('admin');
        //auth()->user()->assignRole('musteri');
        $kullanici = User::where('id', '=',Auth::user()->id)->get();
        return view('admin/home')->with('kullanici', $kullanici);
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
        $kullanici = Musteri::where('user_id', '=',Auth::user()->id)->get();
        $markalar = Marka::all();

        $donecek_dizi = [];
        foreach($kullanici as $key => $kul)
        {
            $kul->Arac;
            $donecek_dizi[$key] = $kul;
            // $donecek_dizi[$key]["araclar"] = $kul->Arac;
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
