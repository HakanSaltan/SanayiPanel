<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use App\userAyar;
class Ayar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
  
    public function handle($request, Closure $next)
    { $response = $next($request);
        $ayar=userAyar::where('user_id', '=', $request->user()->id)->first();
        if(!$ayar) {
            $path = $request->path();
            if($path != "ayar" && $path != "firmaKayit") {
                return redirect('/ayar');
            }
        }

        return $response;
    }
    
}
