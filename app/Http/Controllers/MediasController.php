<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;

class MediasController extends Controller
{

    public function index()
    {

        $albums = Album::orderBy('id')->get();

        return view('index',compact('albums'));
    }

    public function create()
    {
        return view('credit');
    }

    public function store(Request $request)
    {

        $data = New Album();
        $data->uploadImages($request->images,['folder'=>'photos']); //,'images','jpeg','photos'
        $data->uploadImages($request->image_two,['folder'=>'photos_two'], 'images_two');
        $data->save();

        return redirect()->route('albums.index')->with('success','Информация сохранена');
    }

    public function edit($id)
    {

        $item = Album::find($id);
        return view('credit',compact('item'));
    }

    public function update(Request $request, $id)
    {

        $data = Album::find($id);
        $data->uploadImages($request->images,['folder'=>'photos']); //,'images','jpeg','photos'
        $data->uploadImages($request->image_two,['folder'=>'photos_two'], 'images_two');
        $data->save();

        return redirect()->route('albums.index')->with('success','Информация сохранена');
    }

    public function destroy($id)
    {

        $data = Album::find($id);
        $data->delete();

        return redirect()->route('albums.index')->with('success','Информация удалена');
    }

}
