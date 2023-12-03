<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function authenticated()
    {
        if(Auth::user()->role == 'Admin'){
            return redirect()->route('admin.dashboard');
        }elseif(Auth::user()->role == 'Wo'){
            return redirect()->route('wo.dashboard');
        }elseif(Auth::user()->role == 'Mua'){
            return redirect()->route('mua.dashboard');
        }elseif(Auth::user()->role == 'Customer'){
            return redirect()->route('customer.dashboard');
        }else{
            return abort(404);
        }
    }

    // public function login(Request $request)
    // {
    //     $this->validate($request, [
    //         'email' => 'required|string|email|max:100',
    //         'password' => 'required|string',
    //         'g-recaptcha-response' => 'required',
    //     ]);

    //     // Validasi reCAPTCHA
    //     $client = new Client();
    //     $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
    //         'form_params' => array(
    //             'secret' => config('recaptcha.api_secret_key'),
    //             'response' => $request->input('g-recaptcha-response')
    //         )
    //     ]);

    //     $body = json_decode((string) $response->getBody());
    //     if (!$body->success) {
    //         return back()->withErrors(['captcha' => 'ReCaptcha Error']);
    //     }

    //     // Validasi Login
    //     $credentials = $request->only('email', 'password');
    //     if (Auth::attempt($credentials)) {
    //         if(Auth::user()->role == 'Admin'){
    //             return redirect()->route('admin.dashboard');
    //         }elseif(Auth::user()->role == 'Wo'){
    //             return redirect()->route('wo.dashboard');
    //         }elseif(Auth::user()->role == 'Mua'){
    //             return redirect()->route('mua.dashboard');
    //         }elseif(Auth::user()->role == 'Customer'){
    //             return redirect()->route('customer.dashboard');
    //         }else{
    //             return abort(404);
    //         }
    //     }else{
    //         return redirect()->route('login')->with('error', 'Email atau Password salah!');
    //     }
    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
