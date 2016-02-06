<?php namespace App\Http\Controllers;

use App\Post;
use DateTime;
use App\Libraries\Tools;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Libraries\AjaxResponse;
use Illuminate\Support\Facades\Request;

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
		return view('index')->with('posts', $this->getPosts());
	}
	
	public function newPost() {
		$response = new AjaxResponse("Novinka úspěšně přidána");
		if(Tools::loggedRole(2)){
			$newPost = new Post();
			if(empty(Request::input('nadpis'))){
				$response->addError("Nezadal jsi nadpis!");
			}
			else{
				$newPost->nadpis = Request::input('nadpis');
			}
			if(empty(Request::input('text'))){
				$response->addError("Nezadali jste žádný text!");
			}
			else{
				$newPost->text = Request::input('text');
			}
			
			$newPost->aktivni = Tools::loggedRole(1) ? 1 : 0;
			
			if($response->success){
				$newPost->save();
				$response->data = $newPost;
			}
		}
		else{
			$response->addError("Nemáš oprávnění přidat novinku!");
		}
		return json_encode($response);
	}
	
	public function archiv($year, $month){
		return view('index')->with('posts', $this->getPosts($year, $month));
	}
	
	private function getPosts($year = NULL, $month = NULL){
//		var_dump(Auth::check());
//			var_dump(Session::all());
		
		if($year){
			$startDay = new DateTime("{$year}-{$month}-01");
			$endDay = new DateTime(date("Y-m-t", $startDay->getTimestamp()));
		}
		else{
			$endDay = new DateTime();
			$startDay = clone $endDay;
			$startDay->modify("-1 month");
		}
		
		$statement = Post::whereBetween('created_at', 
				array($startDay->format("Y-m-d H:i:00"), $endDay->format("Y-m-d H:i:00")));
		if(!Tools::loggedRole(2)){
			$statement->where('aktivni', 1);
		}
		$posts = $statement->orderBy('created_at', 'DESC')->get();
		return $posts;
	}
	

}
