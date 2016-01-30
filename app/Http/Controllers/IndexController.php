<?php namespace App\Http\Controllers;

use App\Post;
use DateTime;
use App\Libraries\Tools;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
//		var_dump(Auth::check());
//			var_dump(Session::all());
//				die('ta');
		
//		if(array_key_exists("archiv", $_GET)){
//			$datum_ted = new DateTime($_GET["archiv"]);
//		}
//		else{
			$dateNow = new DateTime();
//		}
		$firstDayOfMonth = clone $dateNow;
		$firstDayOfMonth->modify("-1 month");
		
//		if(Tools::loggedRole(2)){
//			$sql = "SELECT * FROM novinky WHERE datum BETWEEN '{$firstDayOfMonth->format("Y-m-d H:i:00")}' AND 
//				'{$dateNow->format("Y-m-d H:i:00")}' ORDER BY datum DESC"; 
//		}
//		else{
//			$sql = "SELECT * FROM novinky WHERE aktivni > 0 AND datum BETWEEN 
//				'{$firstDayOfMonth->format("Y-m-d H:i:00")}' AND '{$dateNow->format("Y-m-d H:i:00")}'
//					ORDER BY datum DESC";
//		}
		$statement = Post::whereBetween('datum', 
				array($firstDayOfMonth->format("Y-m-d H:i:00"), $dateNow->format("Y-m-d H:i:00")));
		if(Tools::loggedRole(2)){
			$statement->where('aktivni', 1);
		}
		$posts = $statement->orderBy('datum', 'DESC')->get();
		return view('index')->with('posts', $posts);
	}

}
