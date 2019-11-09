<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;
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
        $tarih= new Carbon();
        $kullanici = Musteri::where('user_id', '=',Auth::user()->id)->get();
        $faturabilgi = Fatura::where('fatura_id','=', $fatura)->get();
        return view('muhasebe/fatura', ['kullanici' => $kullanici[0]],['fatura'=>$faturabilgi[0]]);
    }
}
