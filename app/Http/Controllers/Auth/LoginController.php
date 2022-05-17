<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/dashboard';

    public function login(Request $request)
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        if (Auth::attempt(['username' => $username, 'password' => $password, 'is_active' => '1'])) {
            return redirect()->route('dashboard');
        }
        return redirect()->back()->withInput()
            ->withErrorMessage('Invalid Username or Password');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('auth.login');
    }
}

