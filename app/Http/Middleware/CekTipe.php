<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekTipe
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$tipe)
    {
        if (in_array($request->user()->tipe,$tipe)) {
            return $next($request);
        }
        return back();
        // return response()->json([
        //     'message' => 'Sorry! User type not valid'
        // ], 506);
    }
}
