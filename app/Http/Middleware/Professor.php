<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Professor {

    public function handle($request, Closure $next) {
        $user = Auth::user();

        if ($user->account_type == 2) {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }

}
