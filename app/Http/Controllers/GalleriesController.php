<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Requests\CreateGalleryRequest;
use App\Image;
use Illuminate\Http\Request;

class GalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = Gallery::orderBy('created_at', 'DESC')->paginate(50);

        return response()->json([
            'galleries' => $galleries,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGalleryRequest $request)
    {
        $gallery = Gallery::create(request()->all());
        $gallery->slug = str_slug(request('title'));
        request()->publish? $gallery->publish = 1 : $gallery->publish = 0;
        $gallery->update();

        return response()->json([
            'gallery' => $gallery
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gallery = Gallery::find($id);

        return response()->json([
            'gallery' => $gallery
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateGalleryRequest $request, $id)
    {
        $gallery = Gallery::find($id);
        $gallery->title = request('title');
        $gallery->slug = str_slug(request('title'));
        $gallery->order = request('order');
        request()->publish? $gallery->publish = 1 : $gallery->publish = 0;
        $gallery->update();

        return response()->json([
            'gallery' => $gallery
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        $gallery->delete();

        return response()->json([
            'gallery' => $gallery
        ]);
    }

    public function image($id){
        $images = Gallery::find($id)->image;

        return response()->json([
            'images' => $images
        ]);
    }

    public function imageUpdate($id){
        Image::saveImage($id, request('file'));
        return 'done';
    }
}
