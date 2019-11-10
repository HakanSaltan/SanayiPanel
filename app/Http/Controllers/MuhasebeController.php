<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Arac;
use App\Fatura;
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
        return view('muhasebe/hizmet', ['kullanici' => htmlspecialchars_decode($kullanici)], ['arac' => $arac_bilgi]);
    }

    public function hizmetEkle($arac_id)
    {
        $arac_id;
    }
}
