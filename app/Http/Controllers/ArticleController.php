<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;

class ArticleController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth')->except('index', 'detail');
        $this->middleware('auth')->except(['index', 'detail']);
    }

    public function index()
    {
        // here, data should be grabbed from the Modal (which is in MVC pattern)
        $data = Article::latest()->paginate(5);

        return view("articles.index", [
            'articles' => $data,
        ]);
    }

    public function detail($id)
    {
        $article = Article::find($id);

        return view("articles.details", [
            "article" => $article,
        ]);
    }

    public function add()
    {
        $category = Category::all();
        return view("articles.add", [
            "categories" => $category,
        ]);
    }

    public function create()
    {

        $validator = validator(request()->all(), [
            "title" => "required",
            "body" => "required",
            "category_id" => "required"
        ]);

        if($validator->fails())
        {
            return back()->withErrors($validator);
        }

        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->user()->id;
        $article->save();

        return redirect("/articles")->with("info", "An article created.");
    }

    public function edit($id)
    {
        $article = Article::find($id);
        $category = Category::all();

        $title = $article->title;
        $body = $article->body;
        $category_id = $article->category_id;

        return view("articles.edit", [
            "title" => $title,
            "body" => $body,
            "category_id" => $category_id,
            "categories" => $category,
        ]);
    }

    public function update($id)
    {
       $article = Article::find($id);

       // updating
       $article->title = request()->title;
       $article->body = request()->body;
       $article->category_id = request()->category_id;

       $article->save();

       return redirect("/articles/details/$article->id")->with("info", "An article is updated.");

    }

    public function delete($id)
    {
        $article = Article::find($id);
        if(Gate::allows('article-delete', $article))
        {
            $article->delete();
            return redirect('/articles')->with('info', 'An article is deleted.');
        }

        return back()->with('info', 'Unauthorized to delete');
    }
}
