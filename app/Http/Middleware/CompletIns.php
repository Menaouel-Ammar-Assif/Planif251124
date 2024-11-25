<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompletIns
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $completins): Response
    {
        if(($request->user()->phone == $completins) || ($request->user()->matricule == $completins)){
            // return redirect("/{$request->user()->role}/dashboard/inscr");
            return redirect("/register");
        }
        return $next($request);
    }
}
