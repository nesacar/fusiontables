<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductLangRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Requests\UploadGalleryRequest;
use App\Photo;
use App\Product;
use Illuminate\Http\Request;
use File;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::select('products.id as id', 'product_translations.title as title', 'products.publish as publish', 'products.created_at as created_at', 'collection_translations.title as collection')
            ->join('product_translations', 'products.id', '=', 'product_translations.product_id')
            ->join('collections', 'products.collection_id', '=', 'collections.id')
            ->join('collection_translations', 'collections.id', '=', 'collection_translations.collection_id')
            ->orderBy('products.created_at', 'DESC')->groupBy('products.id')->paginate(50);
        return response()->json([
            'products' => $products,
        ]);
    }

    public function store(CreateProductRequest $request){
        app()->setLocale('en');
        $product = new Product();
        $product->user_id = request('user_id');
        $product->collection_id = request('collection_id');
        $product->title = request('title');
        request('slug')? $product->slug = str_slug(request('slug')) : $product->slug = str_slug(request('title'));
        $product->short = request('short');
        $product->body = request('body');
        $product->body2 = request('body2');
        $product->price_small = request('price_small');
        $product->price_outlet = request('price_outlet');
        $product->body2 = request('body2');
        request('publish')? $product->publish = true : $product->publish = false;
        $product->save();
        if(request('image')){ Product::base64UploadImage($product->id, request('image')); }

        app()->setLocale('it');
        $product->title = request('title');
        $product->update();

        return response()->json([
            'product' => $product
        ]);
    }

    public function show($id){
        request('locale')? $locale = request('locale') : $locale = 'en';
        app()->setLocale($locale);
        $product = Product::find($id);
        $product['link'] = Product::getProductLink($product);
        return response()->json([
            'product' => $product
        ]);
    }

    public function update(UpdateProductRequest $request, $id){
        $product = Product::find($id);
        $product->user_id = request('user_id');
        $product->collection_id = request('collection_id');
        $product->price_small = request('price_small');
        $product->price_outlet = request('price_outlet');
        request('publish')? $product->publish = true : $product->publish = false;
        $product->update();
        return response()->json([
            'message' => 'done'
        ]);
    }

    public function updateLang(UpdateProductLangRequest $request, $id){
        request('locale')? $locale = request('locale') : $locale = 'en';
        app()->setLocale($locale);
        $product = Product::find($id);
        $product->user_id = request('user_id');
        $product->title = request('title');
        request('slug')? $product->slug = str_slug(request('slug')) : $product->slug = str_slug(request('title'));
        $product->short = request('short');
        $product->body = request('body');
        $product->body2 = request('body2');
        $product->update($request->except('image', 'slug'));
        return response()->json([
            'product' => $product
        ]);
    }

    public function destroy($id){
        $product = Product::find($id);
        if(!empty($product->image)) File::delete($product->image);
        Product::destroy($product->id);
        return response()->json([
            'message' => 'deleted'
        ]);
    }

    public function uploadImage(UploadGalleryRequest $request, $id){
        $image = Product::base64UploadImage($id, request('file'));
        return response()->json([
            'image' => $image
        ]);
    }

    public function galleryUpdate($id){
        Photo::saveImage($id, request('file'));
        return 'done';
    }

    public function gallery($id){
        $photos = Product::find($id)->photo;
        return response()->json([
            'photos' => $photos
        ]);
    }

    public function search(){
        $collection = request('list');
        $text = request('text');
        $products = Product::select('products.id as id', 'product_translations.title as title', 'products.publish as publish', 'products.created_at as created_at', 'collection_translations.title as collection')
            ->join('product_translations', 'products.id', '=', 'product_translations.product_id')
            ->join('collections', 'products.collection_id', '=', 'collections.id')
            ->join('collection_translations', 'collections.id', '=', 'collection_translations.collection_id')
            ->where(function ($query) use ($collection){
                if($collection > 0){
                    $query->where('products.collection_id', $collection);
                }
            })
            ->where(function ($query) use ($text){
                if($text != ''){
                    $query->where('product_translations.title', 'like', '%'.$text.'%')->orWhere('product_translations.title', 'like', '%'.$text.'%');
                }
            })
            ->orderBy('products.created_at', 'DESC')->groupBy('products.id')->paginate(50);
        return response()->json([
            'products' => $products,
        ]);
    }
}
