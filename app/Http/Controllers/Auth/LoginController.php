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
    protected $redirectTo = '';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
	{
		$messages = [
			'email.required' => __('email cant blank'),
			'password.required' => __('password cant bank'),
		];
		return $this->getValidationFactory()->make(
			$request->all(), $rules, $messages, $customAttributes
		)->validate();
	}
	
	protected function login(Request $request)
	{
		$this->validateLogin($request);

		if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1], $request->remember)) {
			return redirect()->route('admin.index');
		}
		return $this->sendFailedLoginResponse($request);
	}

}
