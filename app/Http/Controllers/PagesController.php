<?php

namespace App\Http\Controllers;

use App\Category;
use App\Collection;
use App\Gallery;
use App\Helper;
use App\Http\Requests\SendContactFormRequest;
use App\Menu;
use App\MenuLink;
use App\Post;
use App\Product;
use App\Setting;
use App\Theme;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\LaravelLocalization;

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

    public function proba(){
        $topMenu = MenuLink::getNoParentLinksById(1);
        return view('welcome');
    }
}
