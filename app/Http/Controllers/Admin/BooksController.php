<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Support\Facades\Auth;

use App\Books;

class BooksController extends Controller
{
    function index (Books $books)
    {
        $books = $books->all()->where('author_id', Auth::user()->id);

        return view('admin.books.list', compact('books'));
    }

    function create ()
    {
        return view('admin.books.add');
    }

    function createAction (Request $request)
    { 

        $this->validate($request, [
            'title'  => 'required',
            'description'  => 'required',
            'price'  => 'required|numeric',
            'picture' => 'required',
        ]);

        $mimeTest = explode(".", $request->picture->getClientOriginalName());

        if(end($mimeTest) == 'jpg' || end($mimeTest) == 'gif' || end($mimeTest) == 'png')
        {  
            $urlName = $request->picture->store('book-covers');

            $books = new Books($request->all());
            $books->picture = $urlName;
            $books->author_id = Auth::user()->id;
            
            if($books->save())
            {
                return back()->with('status', 'Nice, book has been added!');
            } else {
                $msg[] = 'Oh no, oh my gosh, something went wrong. Try it one more time.';
                return back()->withErrors($msg);
            }

        } else {
            $msg[] = 'The book has not been added! They only allowed types are PNG, JPG and GIF';
            return back()->withErrors($msg);
        }

    }
    
    function edit (Books $book)
    {
        $book = $book->all()->where('author_id', Auth::user()->id)->first();

        return view('admin.books.edit', compact('book'));
    }

    function editAction (Request $request, Books $book)
    {
        $this->validate($request, [
            'title'  => 'required',
            'description'  => 'required',
            'price'  => 'required|numeric',
        ]);
 
        if ($request->picture) {
            $mimeTest = explode(".", $request->picture->getClientOriginalName());

            if(end($mimeTest) == 'jpg' || end($mimeTest) == 'gif' || end($mimeTest) == 'png')
            {
                $urlName = $request->picture->store('book-covers');
                $book->picture = $urlName;
            } else {
                $msg[] = 'The book has not been updated! They only allowed types are PNG, JPG and GIF';
                return back()->withErrors($msg);
            }
        }              
            
            if($book->update($request->all()))
            {
                return back()->with('status', 'Nice, book has been updated!');
            } else {
                $msg[] = 'Oh no, oh my gosh, something went wrong. Try it one more time.';
                return back()->withErrors($msg);
            }
    }

    function delete ()
    {
        //return view('admin.books.list');
    }

}
