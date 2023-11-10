<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user() && Auth::user()->role == 'Customer'){
            return $next($request);
        } else {
            // Membuat respons dengan status 403 dan pesan kesalahan
            $response = response('Unauthorized action', 403);

            // Menambahkan header Refresh untuk mengalihkan pengguna ke 'home' setelah 5 detik
            $response->header('Refresh', '1;url=' . route('home'));

            return $response;
        }
    }
}