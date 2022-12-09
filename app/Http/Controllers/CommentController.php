<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use App\Models\Comment;
use App\Models\Article;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $comment = new Comment;
        $comment->content = request()->content;
        $comment->article_id = request()->article_id;
        $comment->user_id = request()->user()->id;
        $comment->save();

        return back()->with('success', "A comment added.");
    }

    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('articles.comment-edit',
        [
            "comment" => $comment,
        ]);
    }

    public function update($id)
    {
        $comment = Comment::find($id);

        $comment->content = request()->content;
        $comment->save();

        return redirect("/articles/details/$comment->article_id")->with("edit", "A comment is updated.");
    }

    public function delete($id)
    {
        $comment = Comment::find($id);
        if(Gate::allows('comment-delete', $comment))
        {
            $comment->delete();
            return back()->with('info', "A comment deleted.");
        }

        return back()->with('info', 'Unauthorized to delete');
    }
}
