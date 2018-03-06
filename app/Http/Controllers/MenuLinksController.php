<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMenuLinkRequest;
use App\Menu;
use App\MenuLink;
use Illuminate\Http\Request;

class MenuLinksController extends Controller
{
    public function index(){
        app()->setLocale('en');
        $menu = Menu::find(request('id'));
        $menuLinks = $menu->menuLinks()->orderBy('order', 'ASC')->get();
        return response()->json([
            'menu' => $menu,
            'menuLinks' => $menuLinks
        ]);
    }

    public function store(CreateMenuLinkRequest $request){
        app()->setLocale('en');
        $link = new MenuLink();
        $link->menu_id = request('menu_id');
        $link->title = request('title');
        $link->link = request('link');
        $link->desc = request('desc');
        $link->sufix = request('sufix');
        $link->save();

        return response()->json([
            'link' => $link
        ]);
    }

    public function show($id){
        request('locale')? $locale = request('locale') : $locale = 'en';
        app()->setLocale($locale);
        $link = MenuLink::find($id);

        return response()->json([
            'link' => $link
        ]);
    }

    public function update(CreateMenuLinkRequest $request, $id){
        request('locale')? $locale = request('locale') : $locale = 'en';
        app()->setLocale($locale);
        $link = MenuLink::find($id);
        $link->title = request('title');
        $link->link = request('link');
        $link->desc = request('desc');
        $link->sufix = request('sufix');
        $link->update();

        return response()->json([
            'link' => $link
        ]);
    }

    public function destroy($id){
        MenuLink::destroy($id);
        return response()->json([
            'message' => 'deleted'
        ]);
    }

    public function sort($id){
        $menu = Menu::find($id);
        $links = $menu->menuLinks()->orderBy('order', 'ASC')->get();
        $last = MenuLink::orderBy('order', 'ASC')->first();
        if(empty($last)){
            $id = 1;
        }else{
            $id = $last->id + 1;
        }

        return response()->json([
            'menu' => $menu,
            'links' => $links,
            'lastId' => $id
        ]);
    }

    public function saveOrder($id){
        app()->setLocale('en');
        $menu = Menu::find($id);
        if(!empty(request('links'))){
            foreach (request('links') as $link){
                $old = MenuLink::find($link['id']);
                if(empty($old)){
                    $new = new MenuLink();
                    $new->menu_id = $id;
                    $new->type = 0;
                    $new->order = $link['order'];
                    $new->title = $link['title'];
                    $new->save();
                }else{
                    $old->order = $link['order'];
                    $old->update();
                }
            }
        }

        $links = $menu->menuLinks()->orderBy('order', 'ASC')->get();
        $last = MenuLink::orderBy('order', 'ASC')->first();
        if(empty($last)){
            $id = 1;
        }else{
            $id = $last->id + 1;
        }

        return response()->json([
            'menu' => $menu,
            'links' => $links,
            'lastId' => $id
        ]);
    }
}
