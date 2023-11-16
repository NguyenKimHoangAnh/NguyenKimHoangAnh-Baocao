<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
          return redirect()->route("admin.getlogin");
        }else{
            $user = Auth::user();
            if($user->roles==0){
                return redirect()->route("site.index");
            }
        }
        return $next($request);
    }
}
