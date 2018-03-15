<?php

namespace App\Http\Controllers;

use App\Category;
use App\Collection;
use App\Gallery;
use App\Helper;
use App\Http\Requests\SendContactFormRequest;
use App\Menu;
use App\MenuLink;
use App\MenuLinkClear;
use App\Post;
use App\Product;
use App\ProductClear;
use App\Setting;
use App\Theme;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\LaravelLocalization;
use Symfony\Component\HttpKernel\Profiler\Profile;

class PagesController extends Controller
{
    public function index(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $images = Gallery::first()->image;
        return view('themes.'.$theme.'.pages.home', compact('settings', 'theme', 'images'));
    }

    public function about(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $post = Post::find(1);
        return view('themes.'.$theme.'.pages.about-us', compact('settings', 'theme', 'post'));
    }

    public function design(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $post = Post::find(2);
        return view('themes.'.$theme.'.pages.design', compact('settings', 'theme', 'post'));
    }

    public function testimonials(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $posts = Category::find(3)->post()->publish()->orderBy('publish_at', 'desc')->paginate(3);
        return view('themes.'.$theme.'.pages.testimonials', compact('settings', 'theme', 'posts'));
    }

    public function quality(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $post = Post::find(3);
        return view('themes.'.$theme.'.pages.quality', compact('settings', 'theme', 'post'));
    }

    public function press(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $posts = Category::find(2)->post()->publish()->paginate(3);
        return view('themes.'.$theme.'.pages.press', compact('settings', 'theme', 'posts'));
    }

    public function gallery(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $images = Gallery::find(3)->image()->where('publish', 1)->get();
        if(count($images)==0) return redirect('/');
        return view('themes.'.$theme.'.pages.gallery', compact('settings', 'theme', 'images'));
    }

    public function contact(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        return view('themes.'.$theme.'.pages.contact', compact('settings', 'theme'));
    }

    public function contactForm(SendContactFormRequest $request){
        return request()->all();
    }

    public function collections(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $collection = Collection::find(3);
        $products = !empty($collection)? ProductClear::getProductByCollectionId($collection->id) : [];
        return view('themes.'.$theme.'.pages.collections', compact('settings', 'theme', 'collection', 'products'));
    }

    public function collections2($slug){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $collection = Collection::whereTranslation('slug', $slug)->first();
        $products = !empty($collection)? ProductClear::getProductByCollectionId($collection->id) : [];
        return view('themes.'.$theme.'.pages.collections', compact('settings', 'theme', 'collection', 'products'));
    }

    public function product($collection, $slug, $id){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $collection = Collection::whereTranslation('slug', $collection)->first();
        $product = Product::find($id);
        $photos = $product->photo()->get();
        return view('themes.'.$theme.'.pages.product', compact('settings', 'theme', 'collection', 'product', 'photos'));
    }

    public function proba(){
        return 'done';
    }
}
