<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostLangRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\UploadGalleryRequest;
use App\Http\Requests\UploadPdfRequest;
use App\Post;
use Illuminate\Http\Request;
use File;

class PostsController extends Controller
{
    public function index(){
        app()->setLocale('sr');
        $posts = Post::select('posts.id as id', 'post_translations.title as title', 'posts.publish as publish', 'posts.created_at as created_at', 'category_translations.title as category')
            ->join('post_translations', 'posts.id', '=', 'post_translations.post_id')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->join('category_translations', 'categories.id', '=', 'category_translations.category_id')
            ->orderBy('posts.created_at', 'DESC')->groupBy('posts.id')->paginate(50);
        return response()->json([
            'posts' => $posts,
        ]);
    }

    public function store(CreatePostRequest $request){
        app()->setLocale('sr');
        $post = new Post();
        $post->user_id = request('user_id');
        $post->category_id = request('category_id');
        $post->title = request('title');
        $post->author = request('author');
        request('slug')? $post->slug = str_slug(request('slug')) : $post->slug = str_slug(request('title'));
        $post->short = request('short');
        $post->body = Post::h3Toh4(request('body'));
        request('publish')? $post->publish = true : $post->publish = false;
        $post->save();
        if(request('image')){ Post::base64UploadImage($post->id, request('image')); }
        if(request('pdf')){ Post::base64UploadPdf($post->id, request('pdf')); }

        return response()->json([
            'post' => $post
        ]);
    }

    public function show($id){
        request('locale')? $locale = request('locale') : $locale = 'sr';
        app()->setLocale($locale);
        $post = Post::find($id);
        return response()->json([
            'post' => $post
        ]);
    }

    public function update(UpdatePostRequest $request, $id){
        $post = Post::find($id);
        $post->user_id = request('user_id');
        $post->category_id = request('category_id');
        $post->author = request('author');
        request('publish')? $post->publish = true : $post->publish = false;
        $post->update();
        return response()->json([
            'message' => 'done'
        ]);
    }

    public function updateLang(UpdatePostLangRequest $request, $id){
        request('locale')? $locale = request('locale') : $locale = 'sr';
        app()->setLocale($locale);
        $post = Post::find($id);
        $post->user_id = request('user_id');
        $post->title = request('title');
        request('slug')? $post->slug = str_slug(request('slug')) : $post->slug = str_slug(request('title'));
        $post->short = request('short');
        $post->body = Post::h3Toh4(request('body'));
        $post->update($request->except('image', 'slug'));
        return response()->json([
            'post' => $post
        ]);
    }

    public function destroy($id){
        $post = Post::find($id);
        if(!empty($post->image)) File::delete($post->image);
        Post::destroy($post->id);
        return response()->json([
            'message' => 'deleted'
        ]);
    }

    public function uploadImage(UploadGalleryRequest $request, $id){
        $image = Post::base64UploadImage($id, request('file'));
        return response()->json([
            'image' => $image
        ]);
    }

    public function uploadPdf(UploadPdfRequest $request, $id){
        $pdf = Post::base64UploadPdf($id, request('file'));
        return response()->json([
            'pdf' => $pdf
        ]);
    }

    public function galleryUpdate($id){
        Photo::saveImage($id, request('file'));
        return 'done';
    }

    public function gallery($id){
        $photos = Post::find($id)->photo;
        return response()->json([
            'photos' => $photos
        ]);
    }

    public function search(){
        $category = request('list');
        $text = request('text');
        $posts = Post::select('posts.id as id', 'post_translations.title as title', 'posts.publish as publish', 'posts.created_at as created_at', 'category_translations.title as category')
            ->join('post_translations', 'posts.id', '=', 'post_translations.post_id')
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->join('category_translations', 'categories.id', '=', 'category_translations.category_id')
            ->where(function ($query) use ($category){
                if($category > 0){
                    $query->where('posts.category_id', $category);
                }
            })
            ->where(function ($query) use ($text){
                if($text != ''){
                    $query->where('post_translations.title', 'like', '%'.$text.'%')->orWhere('post_translations.title', 'like', '%'.$text.'%');
                }
            })
            ->orderBy('posts.created_at', 'DESC')->groupBy('posts.id')->paginate(50);
        return response()->json([
            'posts' => $posts,
        ]);
    }
}
