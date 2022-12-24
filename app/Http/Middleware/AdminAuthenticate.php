<?php
namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminAuthenticate 
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // check if normal user try to access admin section
    if (!isCheckAdmin()) {
                if ($request->is('admin') or $request->is('admin/*')) {
                if ($request->ajax()) {
                    return __apiResponse([
                                    'auth_info' => getUserAuthInfo(),
                                ], 10);
                }
// echo Auth::user()->role;
// die;
               return redirect()->route('user.profile_view', ['username' => getUserAuthInfo('profile.username')]);
            }
        }
     
        // Check if demo mode is on
        // if ($request->isMethod('post')
        //         and isCheckAdmin()
        //     ) {
        //         return __apiResponse([
        //                 'message' => __tr('Saving functionality is disabled in this demo.'),
        //                 'show_message' => true
        //             ], 1);
        // }

        return $next($request);
    }
}