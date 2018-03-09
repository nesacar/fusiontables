<?php

namespace App\Http\Controllers;

use App\Category;
use App\Collection;
use App\Gallery;
use App\Helper;
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

    public function proba(){
        /*$old = Post::first();

        for ($i=1;$i<=20;$i++){
            $new = new Post();
            $new->user_id = $old->user_id;
            $new->category_id = $old->category_id;
            $new->image = $old->image;
            $new->title = 'News post ' . $i;
            $new->slug = str_slug('News post ' . $i);
            $new->short = $old->short;
            $new->body = $old->body;
            $new->publish_at = Carbon::now();
            $new->publish = 1;
            $new->save();

            sleep(1);
        }*/
        return 'done';
    }
}
