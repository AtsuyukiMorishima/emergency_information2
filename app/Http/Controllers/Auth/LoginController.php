<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;

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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Over riding login method
     * Write code on Method
     *
     * @return response()
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        //バリデーション:エラー
        if ($validator->fails()) {
            return redirect('/login')
                ->withInput()
                ->withErrors($message);
        }
        // $credentials = $request->only('email', 'password');
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 1,'id' => 1])) {
            return redirect()->route('admin');
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 2])) {
            return redirect()->route('admin');
        }

        session()->flash('flash_message', '入力情報が間違っています');
        return redirect("login");
    }
}
