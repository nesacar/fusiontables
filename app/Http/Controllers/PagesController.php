<?php

namespace App\Http\Controllers;

use App\Architect;
use App\Category;
use App\Collection;
use App\Gallery;
use App\Helper;
use App\Http\Requests\RegisterArchitectClubRequest;
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
        $translate = ['sr' => 'sr', 'en' => 'en', 'hr' => 'hr'];
        return view('themes.'.$theme.'.pages.home', compact('settings', 'theme', 'images', 'topMenu', 'translate'));
    }

    public function about(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $post = Post::find(1);
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        $translate = ['sr' => 'sr/o-nama', 'en' => 'en/about-us', 'hr' => 'hr/o-nama'];
        return view('themes.'.$theme.'.pages.about-us', compact('settings', 'theme', 'post', 'topMenu', 'translate'));
    }

    public function design(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $post = Post::find(2);
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        $translate = ['sr' => 'sr/dizajn', 'en' => 'en/design', 'hr' => 'hr/dizajn'];
        return view('themes.'.$theme.'.pages.design', compact('settings', 'theme', 'post', 'topMenu', 'translate'));
    }

    public function testimonials(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $posts = Category::find(3)->post()->publish()->orderBy('created_at', 'desc')->paginate(6);
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        $translate = ['sr' => 'sr/iskustva', 'en' => 'en/testimonials', 'hr' => 'hr/iskustva'];
        return view('themes.'.$theme.'.pages.testimonials', compact('settings', 'theme', 'posts', 'topMenu', 'translate'));
    }

    public function quality(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $post = Post::find(3);
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        $translate = ['sr' => 'sr/kvalitet', 'en' => 'en/quality', 'hr' => 'hr/kvalitet'];
        return view('themes.'.$theme.'.pages.quality', compact('settings', 'theme', 'post', 'topMenu', 'translate'));
    }

    public function press(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $posts = Category::find(2)->post()->publish()->paginate(3);
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        $translate = ['sr' => 'sr/press', 'en' => 'en/press', 'hr' => 'hr/press'];
        return view('themes.'.$theme.'.pages.press', compact('settings', 'theme', 'posts', 'topMenu', 'translate'));
    }

    public function gallery(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $images = Gallery::find(3)->image()->where('publish', 1)->get();
        if(count($images)==0) return redirect('/');
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        $translate = ['sr' => 'sr/galerija', 'en' => 'en/gallery', 'hr' => 'hr/galerija'];
        return view('themes.'.$theme.'.pages.gallery', compact('settings', 'theme', 'images', 'topMenu', 'translate'));
    }

    public function contact(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        $translate = ['sr' => 'sr/kontakt', 'en' => 'en/contact', 'hr' => 'hr/kontakt'];
        return view('themes.'.$theme.'.pages.contact', compact('settings', 'theme', 'topMenu', 'translate'));
    }

    public function contactForm(SendContactFormRequest $request){
        $message = Message::create(request()->all());
        \Mail::to(['jova.sreco@ministudio.rs', 'nenad@ministudio.rs', 'nebojsa.markovic@ministudio.rs'])->send(new ContactFormMessage($message));
        \Session::flash('message', 'poruka');
        return redirect('/');
    }

    public function architectClub(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        $post = Post::find(19);
        $translate = ['sr' => 'sr/architect-club', 'en' => 'en/architect-club', 'hr' => 'hr/architect-club'];
        return view('themes.'.$theme.'.pages.architect-club', compact('settings', 'theme', 'topMenu', 'post', 'translate'));
    }

    public function architectClubUpdate(RegisterArchitectClubRequest $request){
        $old = Architect::where('email', request('email'))->first();
        if(empty($old)){
            Architect::create(request()->all());
        }
        \Session::put('architect', 'Architect');
        return redirect()->back();
    }

    public function catalog(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        $post = Post::find(20);
        $translate = ['sr' => 'sr/katalog', 'en' => 'en/catalog', 'hr' => 'hr/katalog'];
        return view('themes.'.$theme.'.pages.catalog', compact('settings', 'theme', 'topMenu', 'post', 'translate'));
    }

    public function collections(){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $collection = Collection::find(3);
        $products = !empty($collection)? ProductClear::getProductByCollectionId($collection->id, app()->getLocale()) : [];
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        $translate = ['sr' => 'sr/kolekcije', 'en' => 'en/collections', 'hr' => 'hr/kolekcije'];
        return view('themes.'.$theme.'.pages.collections', compact('settings', 'theme', 'collection', 'products', 'topMenu', 'translate'));
    }

    public function collections2($slug){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $collection = Collection::whereTranslation('slug', $slug)->first();
        $products = !empty($collection)? ProductClear::getProductByCollectionId($collection->id, app()->getLocale()) : [];
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        $translate = ['sr' => 'sr/kolekcije/'.$collection->slug, 'en' => 'en/collections/'.$collection->slug, 'hr' => 'hr/kolekcije/'.$collection->slug];
        return view('themes.'.$theme.'.pages.collections', compact('settings', 'theme', 'collection', 'products', 'topMenu', 'translate'));
    }

    public function product($collection, $slug, $id){
        $settings = Setting::first();
        $theme = Theme::getTheme();
        $collection = Collection::whereTranslation('slug', $collection)->first();
        $product = Product::find($id);
        $photos = $product->photo()->get();
        $topMenu = MenuLinkClear::getNoParentLinksById(1, app()->getLocale());
        $translate = [
            'sr' => 'sr/'.$collection->slug.'/'.$product->slug.'/'.$product->id,
            'en' => 'en/'.$collection->slug.'/'.$product->slug.'/'.$product->id,
            'hr' => 'hr/'.$collection->slug.'/'.$product->slug.'/'.$product->id
        ];
        return view('themes.'.$theme.'.pages.product', compact('settings', 'theme', 'collection', 'product', 'photos', 'topMenu', 'translate'));
    }

    public function proba(){
        $route = Helper::getRoute();
        if($route == 'proba'){
            return 'da';
        }else{
            return 'ne';
        }
    }
}
