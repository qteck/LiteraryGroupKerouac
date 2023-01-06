<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller;
use Illuminate\Support\Facades\Auth;
use App\Gallery;
use App\Photo;

class AdminGalleryController extends Controller
{
    function index (Gallery $galleries)
    {
        $listOfGalleries = $galleries->all();

        return view('admin.galleries.list', compact('listOfGalleries'));
    }



    function addGallery(){}
    function deleteGallery(Gallery $galleries, $id)
    {
           $state = $galleries->destroy($id);

           $msg[] = $state == true ? 'Gallery has been removed':'Problem has accured. Try it later.';
            return back()->withErrors($msg);
    }

    function editGallery(Gallery $galleries)
    {
        $listOfGalleries = $galleries->all();

         return view('admin.galleries.add',  compact('listOfGalleries'));
    }

    function addPicture(Request $request, Gallery $gallery){
        $files = $request->hasFile('pictures') ? $request->pictures : [];
        $title = $request->title;

       
        $doesTheGalleryExist = $gallery->where('title', '=', $title)->first();

        if($doesTheGalleryExist == TRUE) 
        {
            $galleryId = $doesTheGalleryExist->id;
        } 
        else
        {
            $gallery->title = $title;
            $gallery->save();

            $galleryId = $gallery->id;
        }

                

        foreach($files as $val)
        {
            $photo = new Photo;

            $picGalleryTitleAndName = $val->store(str_replace(' ', '-', iconv('UTF-8', 'ASCII//TRANSLIT', $title)));
            
            $photo->title = $picGalleryTitleAndName;
            $photo->galleries_id = $galleryId;
            $photo->save();
/*
            echo asset('storage/'.$picGalleryTitleAndName);
            echo "<img src='". asset('storage/'.$picGalleryTitleAndName) ."'>";
           */
        }

        return redirect()->back();
    }

    function deletePicture(){}
}
