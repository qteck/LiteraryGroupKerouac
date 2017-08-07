<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Article;
use App\Note;
use Validator;

class AddArticleController extends Controller
{
    public function indexCreate()
    {
        $currentTime = Carbon::now();

        return view('admin.articles.add', compact('currentTime'));
    }

    public function indexUpdate($id)
    {
        $articleToEdit = Article::all()->where('author_id', Auth::user()->id)
                            ->where('id', $id)->first();

        $currentTime = Carbon::now();

        return view('admin.articles.edit', compact('currentTime', 'articleToEdit'));
    }

    public function storyline(Request $request, Article $storyline)
    {

       $storyline->update($request->all());

        if($request->ajax())
        {
            return '{}';
            exit;
        } 
        else {
            return back();
        }
    }

    public function listOfArticles()
    {
        $listOfArticles = Article::where('author_id', Auth::user()->id)->orderBy('scheduled', 'desc')->get();

        return view('admin.articles.list', compact('listOfArticles'));
    }
}
