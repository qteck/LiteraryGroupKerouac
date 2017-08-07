<?php

namespace App\Http\Controllers\Clanky;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Article;
use App\Month;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Validator;

class ClankyController extends Controller
{
    public function index($mesic = null)
    {
        $current_time = Carbon::now();
        $articles = Article::where('scheduled', '<=', $current_time)
                                                ->where('status', '=', 'published')
                                                ->orderBy('scheduled', 'desc')->get();

            //dd($articles);

        if (!empty($mesic)) {
            $articles = $articles->where('month_id', '=', $mesic)->where('status', '=', 'published');
            $articles->currentMonth = Month::all()->where('id', '=', $mesic)->first()->month; // h1 month

            if (empty($articles->toArray())) {
                \App::abort(404);
            }
        }


        $months = Month::withCount(['articles' => function ($query) {
                $query->where('status', '=', 'published');
            }])->get();    // fetch all the months

        return view('clanky.clanky', compact('articles', 'months'));
    }

    public function show(Article $article)
    {
        return view('clanky.clanky-show', compact('article'));
    }
    
    public function create(Request $request)
    {
        $current_time = Carbon::now();
        $buildScheduledTime = trim($request->scheduledDate.' '.$request->scheduledTime);
        $scheduledTime = !empty($buildScheduledTime) ? Carbon::createFromFormat('d.m.Y H:i', $buildScheduledTime): null;

        if ($request->status == 'Publish' || $request->status == 'Update') {
            $this->validate($request, [
                'title' => 'required|min:3',
                'contentInBrief' => 'required|min:100',
                'content' => 'required|min:1000',
                'place' => 'required|min:3'
            ]);
        }

        $article = new Article($request->all());
        $article->status = $request->status == 'Publish' ? 'published' : 'draft';
        $article->scheduled = is_null($scheduledTime) ? $current_time:  $scheduledTime;
        $article->author_id = $request->user()->getKey();
        $article->month_id = $current_time->format('m');
        $article->content_in_brief = $request->contentInBrief;
        $article->save();

        return redirect(url('/').'/admin/dealer/edit-article/'.$article->id)
                                                ->withInput()
                                                ->with('success', 'Your article has been saved.');
    }

    public function update(Article $article, Request $request)
    {
         $current_time = Carbon::now();
         $data = $request->all();

        $buildScheduledTime = trim($request['scheduledDate'].' '.$request['scheduledTime']);
        $scheduledTime = !empty($buildScheduledTime) ? Carbon::createFromFormat('d.m.Y H:i', $buildScheduledTime): null;

/*
        if($data['status'] == 'Publish')
        {
            $this->validate($data, [
                'title' => 'required|min:3',
                'contentInBrief' => 'required|min:100',
                'content' => 'required|min:1000',
                'place' => 'required|min:3'
            ]);
         }
*/
        $data['status'] = ($data['status']  == 'Publish' || $data['status']  == 'Update') ? 'published' : 'draft';
        $data['scheduled'] = is_null($scheduledTime) ? $current_time :  $scheduledTime;
        $state = $article->update($data);

        return json_encode(array('state' => 1));
        exit;
    }

    function delete(Article $articles, $article)
    {
           $state = $articles->destroy($article);

           $msg[] = $state == true ? 'Article has been removed':'Problem has accured. Try it later.';
            return back()->withErrors($msg);
    }
}
