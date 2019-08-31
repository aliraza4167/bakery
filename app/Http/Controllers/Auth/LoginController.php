<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\request;
use Validator;
use App\User;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request) 
    {
        // VALIDATION OF THE DATA
        $validator = Validator::make($request->all(), [
            'email' => array('required', 'regex:/(^[a-z1-9_]{4,15}[@]{1}[a-z]{5,10}[.]{1}[a-z]{1,3})/u'),
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('/login')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect('/products');
            } else {
                return redirect('/login');
            }
        }

        
    }
}
