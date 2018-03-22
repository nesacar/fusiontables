<?php

namespace App\Http\Controllers;

use App\Category;
use App\Collection;
use App\Gallery;
use App\Helper;
use App\Http\Requests\SendContactFormRequest;
use App\Mail\ContactFormMessage;
use App\Menu;
use App\MenuLink;
use App\MenuLinkClear;
use App\Message;
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
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        return view('themes.'.$theme.'.pages.home', compact('settings', 'theme', 'images', 'topMenu'));
    }

    public function about(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $post = Post::find(1);
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        return view('themes.'.$theme.'.pages.about-us', compact('settings', 'theme', 'post', 'topMenu'));
    }

    public function design(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $post = Post::find(2);
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        return view('themes.'.$theme.'.pages.design', compact('settings', 'theme', 'post', 'topMenu'));
    }

    public function testimonials(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $posts = Category::find(3)->post()->publish()->orderBy('created_at', 'desc')->paginate(6);
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        return view('themes.'.$theme.'.pages.testimonials', compact('settings', 'theme', 'posts', 'topMenu'));
    }

    public function quality(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $post = Post::find(3);
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        return view('themes.'.$theme.'.pages.quality', compact('settings', 'theme', 'post', 'topMenu'));
    }

    public function press(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $posts = Category::find(2)->post()->publish()->paginate(3);
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        return view('themes.'.$theme.'.pages.press', compact('settings', 'theme', 'posts', 'topMenu'));
    }

    public function gallery(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $images = Gallery::find(3)->image()->where('publish', 1)->get();
        if(count($images)==0) return redirect('/');
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        return view('themes.'.$theme.'.pages.gallery', compact('settings', 'theme', 'images', 'topMenu'));
    }

    public function contact(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        return view('themes.'.$theme.'.pages.contact', compact('settings', 'theme', 'topMenu'));
    }

    public function contactForm(SendContactFormRequest $request){
        $message = Message::create(request()->all());
        \Mail::to(['jova.sreco@ministudio.rs', 'nenad@ministudio.rs', 'nebojsa.markovic@ministudio.rs'])->send(new ContactFormMessage($message));
        \Session::flash('message', 'poruka');
        return redirect('/');
    }

    public function collections(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $collection = Collection::find(3);
        $products = !empty($collection)? ProductClear::getProductByCollectionId($collection->id) : [];
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        return view('themes.'.$theme.'.pages.collections', compact('settings', 'theme', 'collection', 'products', 'topMenu'));
    }

    public function collections2($slug){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $collection = Collection::whereTranslation('slug', $slug)->first();
        $products = !empty($collection)? ProductClear::getProductByCollectionId($collection->id) : [];
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        return view('themes.'.$theme.'.pages.collections', compact('settings', 'theme', 'collection', 'products', 'topMenu'));
    }

    public function product($collection, $slug, $id){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $collection = Collection::whereTranslation('slug', $collection)->first();
        $product = Product::find($id);
        $photos = $product->photo()->get();
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        return view('themes.'.$theme.'.pages.product', compact('settings', 'theme', 'collection', 'product', 'photos', 'topMenu'));
    }

    public function proba(){
        dd(app()->getLocale());
        return $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
    }
}
