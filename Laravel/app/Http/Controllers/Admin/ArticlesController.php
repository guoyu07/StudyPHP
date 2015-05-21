<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Article;
use Redirect, Input;

class ArticlesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view("admin.articles.index")->withArticles(Article::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view("admin.articles.create");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, [
		    'title' => 'required|unique:articles|max:255|min:5',
		    'body' => 'required'
		]);
		
		$article = new Article();
		$article->title = Input::get('title');
		$article->body = Input::get('body');
		$article->user_id = 1; //Auth::user()-id;
		
		if ($article->save()) {
		    return Redirect::to('admin/articles');
		} else {
		  return Redirect::back()->withInput()->withErrors('保存文章失败！');
		}
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
		return view('admin.articles.edit')->withArticle(Article::find($id));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
	  $this->validate($request, [
	      'title' => 'required|unique:articles|max:255|min:5',
	      'body' => 'required'
	      ]);
	  
	  $article = Article::find($id);
	  $article->title = Input::get('title');
	  $article->body = Input::get('body');
	  $article->user_id = 1; //Auth::user()-id;
	  
	  if ($article->save()) {
	    return Redirect::to('admin/articles');
	  } else {
	    return Redirect::back()->withInput()->withErrors('保存文章失败！');
	  }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$article = Article::find($id);
		$article->delete();
		
		return Redirect::to('admin/articles');
	}

}
