<?php

namespace App\Http\Controllers;

use App\Collection;
use App\Http\Requests\CreateCollectionRequest;
use Illuminate\Http\Request;

class CollectionsController extends Controller
{
    public function index(){
        $collections = Collection::select('collections.id as id', 'collection_translations.title as title', 'collections.publish as publish', 'collections.created_at as created_at')
            ->join('collection_translations', 'collections.id', '=', 'collection_translations.collection_id')
            ->orderBy('collections.order', 'ASC')->groupBy('collections.id')->paginate(50);
        return response()->json([
            'collections' => $collections,
        ]);
    }

    public function store(CreateCollectionRequest $request){
        app()->setLocale('en');
        $collection = new Collection();
        $collection->title = request('title');
        request('slug')? $collection->slug = str_slug(request('slug')) : $collection->slug = str_slug(request('title'));
        $collection->desc = request('desc');
        $collection->parent = request('parent');
        $collection->order = request('order');
        request('publish')? $collection->publish = true : $collection->publish = false;
        $collection->save();

        return response()->json([
            'collection' => $collection
        ]);
    }

    public function show($id){
        request('locale')? $locale = request('locale') : $locale = 'en';
        app()->setLocale($locale);
        $collection = Collection::find($id);
        return response()->json([
            'collection' => $collection
        ]);
    }

    public function update($id){
        $collection = Collection::find($id);
        $collection->parent = request('parent');
        $collection->order = request('order');
        request('publish')? $collection->publish = true : $collection->publish = false;
        $collection->update();
        return response()->json([
            'message' => 'done'
        ]);
    }

    public function updateLang(CreateCollectionRequest $request, $id){
        request('locale')? $locale = request('locale') : $locale = 'en';
        app()->setLocale($locale);
        $collection = Collection::find($id);
        $collection->title = request('title');
        request('slug')? $collection->slug = str_slug(request('slug')) : $collection->slug = str_slug(request('title'));
        $collection->desc = request('desc');
        $collection->update($request->except('image', 'slug'));
        return response()->json([
            'collection' => $collection
        ]);
    }

    public function destroy($id){
        $collection = Collection::find($id);
        if(!empty($collection->image)) File::delete($collection->image);
        Collection::destroy($collection->id);
        return response()->json([
            'message' => 'deleted'
        ]);
    }

    public function uploadImage($id){
        $image = Collection::base64UploadImage($id, request('image'));
        return response()->json([
            'image' => $image
        ]);
    }

    public function uploadHeroImage($id){
        $image = Collection::base64UploadHeroImage($id, request('image'));
        return response()->json([
            'image' => $image
        ]);
    }

    public function uploadHeroImageMobile($id){
        $image = Collection::base64UploadHeroImageMobile($id, request('image'));
        return response()->json([
            'image' => $image
        ]);
    }

    public function lists(){
        $locale = 'en';
        app()->setLocale($locale);
        $collections = Collection::join('collection_translations', 'collections.id', '=', 'collection_translations.collection_id')
            ->where('collections.publish', 1)->orderBy('collection_translations.title', 'ASC')->where('collection_translations.locale', $locale)
            ->pluck('collection_translations.title', 'collections.id')->prepend('Without collection', 0);
        return response()->json([
            'collections' => $collections
        ]);
    }

    public function parentLists(){
        $locale = 'en';
        app()->setLocale($locale);
        $collections = Collection::join('collection_translations', 'collections.id', '=', 'collection_translations.collection_id')
            ->where('collections.publish', 1)->where('collections.parent', 0)->orderBy('collection_translations.title', 'ASC')->where('collection_translations.locale', $locale)
            ->pluck('collection_translations.title', 'collections.id')->prepend('Without collection', 0);
        return response()->json([
            'collections' => $collections
        ]);
    }

    public function search(){
        $text = request('text');
        $parent = request('list');
        $collections = Collection::select('collections.id as id', 'collection_translations.title as title', 'collections.publish as publish', 'collections.created_at as created_at')
            ->join('collection_translations', 'collections.id', '=', 'collection_translations.collection_id')
            ->where(function ($query) use ($text){
                if($text != ''){
                    $query->where('collection_translations.title', 'like', '%'.$text.'%')->orWhere('collection_translations.title', 'like', '%'.$text.'%');
                }
            })
            ->where(function ($query) use ($parent){
                if($parent > 0){
                    $query->where('collections.parent', $parent);
                }
            })
            ->orderBy('collections.order', 'ASC')->groupBy('collections.id')->paginate(50);
        return response()->json([
            'collections' => $collections,
        ]);
    }
}
