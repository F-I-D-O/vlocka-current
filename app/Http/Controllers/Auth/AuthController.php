<?php namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/

	use AuthenticatesAndRegistersUsers;
	
	protected $username = 'nick';
	
	protected $password = 'password';

	/**
	 * Create a new authentication controller instance.
	 *
	 * @param  \Illuminate\Contracts\Auth\Guard  $auth
	 * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
	 * @return void
	 */
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}
	
	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postLogin(Request $request)
	{
		$this->validate($request, [
			$this->username => 'required', $this->password => 'required',
		]);

		$credentials = $request->only($this->username, $this->password);
		$credentials[$this->password] .= $credentials[$this->username];
//		var_dump($this->auth);
		if ($this->auth->attempt($credentials, $request->has('remember')))
		{
//			var_dump(Auth::user());
//			var_dump(Session::all());
//				die('ta');
			return Redirect::back();
		}

		return Redirect::back()
					->withInput($request->only($this->username, 'remember'))
					->withErrors([
						$this->username => $this->getFailedLoginMessage(),
					]);
	}
	
	/**
	* Handle a logout request to the application.
	*
	* @return \Illuminate\Http\Response
	*/
	public function postLogout()
	{
		Auth::logout();
		return Redirect::back();
	}

	
}
