<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Repositories\Manager;
use App\Repositories\System;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller
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
    protected $redirectTo = '/manager';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest:manager')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    protected function credentials(Request $request)
    {
        $re = $request->only($this->username(), 'password');

        return $re;
    }

    //登陆数据
    public function showLoginForm()
    {

        if (request()->isMethod('post')) {
            return $this->login(request());
        }
        $system = System::initById(1);
        return view('manager.public.login', ['system' => $system]);
    }

    //退出登陆
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect()->route('manager');
    }


    public function guard()
    {
        return Auth::guard('manager');
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    protected function attemptLogin(Request $request)
    {
        $user = Manager::getByUsername($request->input(['username']));
        if(!$user){
            throw ValidationException::withMessages([
                $this->username() => ['用户不存在'],
            ]);
        }
        if($user->status != 1){
            throw ValidationException::withMessages([
                $this->username() => ['该账户已被禁用'],
            ]);
        }
        if($user->checkPassword($request->input(['password']))){
            return $this->guard()->login(
                $user->data, $request->filled('remember')
            );
        }else{
            throw ValidationException::withMessages([
                $this->username() => ['密码错误'],
            ]);
        }
    }

}
