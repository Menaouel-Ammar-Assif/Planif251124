<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\UsersBlocked;

class UserBlock
{
    public function handle(Request $request, Closure $next)
    {
        $userId = auth()->id();

        // Check if the user is blocked
        if ($userId) {
            $isBlocked = UsersBlocked::where('id_user', $userId)->exists();
            if ($isBlocked) {
                return redirect("/userBlock");
            }
        }
        return $next($request);
    }
}
