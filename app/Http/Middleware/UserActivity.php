<?php

namespace App\Http\Middleware;
  
use Closure;
use Illuminate\Http\Request;
use Auth;
use Cache;
use App\User;
use App\Instructor;
class UserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    // public function handle($request, Closure $next)
    // {
    //     return $next($request);
    // }
    
    
    
    
    public function handle(Request $request, Closure $next)
    {
        $userid = Auth::guard('instructors')->user();
        if (Auth::guard('instructors')->user()) {
            $expiresAt = now()->addMinutes(2); /* keep online for 2 min */
            Cache::put('user-is-online-' . $userid->id, true, $expiresAt);
  
            /* last seen */
            Instructor::where('id', $userid->id)->update(['last_seen' => now()]);
        }
  
        return $next($request);
    }
}




