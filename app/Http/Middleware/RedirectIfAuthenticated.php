<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exp\Components\User\Models\UserProfile;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
        if(Auth::user()->role == 0 || Auth::user()->role == 1){
                  return redirect(RouteServiceProvider::AdminTeamRedirection);
        }else{
                if(getUserSettings('skip_profile', Auth::user()->_id) == 1){
                   return redirect(RouteServiceProvider::UserRedirection);
               }else{
                 $userProfile = UserProfile::where("users__id",Auth::user()->_id)->first();
                 if(isset($userProfile->city)){
                   return redirect(RouteServiceProvider::UserRedirection);
               }else{
                   return redirect(RouteServiceProvider::HOME);
               }               
           }
           }
       }
   }

   return $next($request);
}
}
