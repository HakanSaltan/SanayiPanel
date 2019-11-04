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
        return view('home')->with('kullanici', $kullanici);
    }
    public function profile()
    {
        $kullanici = User::where('id', '=',Auth::user()->id)->get();

        return view('profile')->with('kullanici', $kullanici);
    }
    public function musterilerim()
    {
        $kullanicilar = Musteri::where('user_id', '=',Auth::user()->id)->get();


        return view('musteriler')->with('kullanicilar', $kullanicilar);
    }
    public function araclarim()
    {
        $kullanicilar = Musteri::where('user_id', '=',Auth::user()->id)->get();
        $markalar = Marka::all();

        return view('araclar', ['kullanicilar' => $kullanicilar],['markalar'=>$markalar]);
       
    }
}
