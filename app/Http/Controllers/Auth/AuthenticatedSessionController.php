<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Role;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $url = '';

        $role = $request->user()->role;

        if ($role) {
            switch ($role) {
                case 'admin':
                    $url = 'admin/dashboard';
                    break;
                case 'directeur':
                    $url = 'directeur/dashboard';
                    break;
                case 'consult':
                    $url = 'consult/dashboard';
                    break;
                default:
                    
                    break;
            }
        }
        
        return redirect()->intended($url);


        // if($request->user()->role === 'admin') { $url = 'admin/dashboard';}
        // elseif($request->user()->role === 'directeur') { $url = 'directeur/dashboard';}
        // elseif($request->user()->role === 'consult') { $url = 'consult/dashboard';}

        // return redirect()->intended($url);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
