<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use Illuminate\Http\Request;
use File;

class CategoriesController extends Controller
{
    public function index(){
        $categories = Category::select('categories.id as id', 'category_translations.title as title', 'categories.publish as publish', 'categories.created_at as created_at')
            ->join('category_translations', 'categories.id', '=', 'category_translations.category_id')
            ->orderBy('categories.created_at', 'DESC')->groupBy('categories.id')->paginate(50);
        return response()->json([
            'categories' => $categories,
        ]);
    }

    public function store(CreateCategoryRequest $request){
        app()->setLocale('en');
        $category = new Category();
        $category->title = request('title');
        request('slug')? $category->slug = str_slug(request('slug')) : $category->slug = str_slug(request('title'));
        $category->desc = request('desc');
        $category->order = 1;
        request('publish')? $category->publish = true : $category->publish = false;
        $category->save();

        return response()->json([
            'category' => $category
        ]);
    }

    public function show($id){
        request('locale')? $locale = request('locale') : $locale = 'en';
        app()->setLocale($locale);
        $category = Category::find($id);
        return response()->json([
            'category' => $category
        ]);
    }

    public function update($id){
        $category = Category::find($id);
        request('publish')? $category->publish = true : $category->publish = false;
        $category->update();
        return response()->json([
            'message' => 'done'
        ]);
    }

    public function updateLang(CreateCategoryRequest $request, $id){
        request('locale')? $locale = request('locale') : $locale = 'en';
        app()->setLocale($locale);
        $category = Category::find($id);
        $category->title = request('title');
        request('slug')? $category->slug = str_slug(request('slug')) : $category->slug = str_slug(request('title'));
        $category->desc = request('desc');
        $category->update($request->except('image', 'slug'));
        return response()->json([
            'category' => $category
        ]);
    }

    public function destroy($id){
        $category = Category::find($id);
        if(!empty($category->image)) File::delete($category->image);
        Category::destroy($category->id);
        return response()->json([
            'message' => 'deleted'
        ]);
    }

    public function uploadImage($id){
        $image = Category::base64UploadImage($id, request('image'));
        return response()->json([
            'image' => $image
        ]);
    }

    public function lists(){
        $locale = 'en';
        app()->setLocale($locale);
        $categories = Category::join('category_translations', 'categories.id', '=', 'category_translations.category_id')
            ->where('categories.publish', 1)->orderBy('category_translations.title', 'ASC')->where('category_translations.locale', $locale)
            ->pluck('category_translations.title', 'categories.id')->prepend('Without category', 0);
        return response()->json([
            'categories' => $categories
        ]);
    }
}
