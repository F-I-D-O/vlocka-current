<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use App\Libraries\AjaxResponse;
use App\Libraries\Tools;
use App\Post;

class PostController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$response = new AjaxResponse("Novinka úspěšně smazána");
		if(Request::has('aktivni')){
			if(Tools::loggedRole(1)){
				$post = Post::find($id);
				$post->aktivni = Request::input('aktivni');
				$post->save();
				$response->data = $id;
			}
			else{
				$response->addError("Nemáš oprávnění k akci!");
			}
		}
		
		return json_encode($response);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$response = new AjaxResponse("Novinka úspěšně smazána");
		if(Tools::loggedRole(1)){
			$post = Post::find($id);
//			var_dump($post);die;
			$post->delete();
			$response->data = $id;
		}
		else{
			$response->addError("Nemáš oprávnění smazat novinku!");
		}
		return json_encode($response);
	}

}
