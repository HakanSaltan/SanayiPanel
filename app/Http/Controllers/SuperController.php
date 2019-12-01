<?php

namespace App\Http\Controllers;

use App\User;
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

class SuperController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function musterilerim()
    {
        $kullanicilar = User::all();

        return view('superadmin/kullanicilar')->with('kullanicilar', $kullanicilar);
    }
}
