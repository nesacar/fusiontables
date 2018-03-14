<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuLinkClear extends Model
{
    protected $table = 'menu_links';

    public $translatedAttributes = ['title', 'link', 'desc', 'sufix'];

    protected $fillable = ['id', 'menu_id', 'category_id', 'type', 'order', 'parent', 'level', 'publish'];

    public static function getNoParentLinksById($id, $locale='sr'){
        return self::select('menu_links.id as id', 'menu_link_translations.link as link', 'menu_link_translations.title as title', 'menus.id as menu_id')
            ->join('menu_link_translations', 'menu_links.id', '=', 'menu_link_translations.menu_link_id')
            ->join('menus', 'menu_links.menu_id', '=', 'menus.id')
            ->where('menus.id', $id)->where('menu_link_translations.locale', $locale)->where('menu_links.parent', 0)->where('menu_links.publish', 1)
            ->orderBy('menu_links.order', 'ASC')->get();
    }

    public static function getParentLinksById($menu_id, $parent_id, $locale='sr'){
        return self::select('menu_links.id as id', 'menu_link_translations.link as link', 'menu_link_translations.title as title', 'menus.id as menu_id')
            ->join('menu_link_translations', 'menu_links.id', '=', 'menu_link_translations.menu_link_id')
            ->join('menus', 'menu_links.menu_id', '=', 'menus.id')
            ->where('menus.id', $menu_id)->where('menu_links.parent', $parent_id)->where('menu_link_translations.locale', $locale)->where('menu_links.publish', 1)
            ->orderBy('menu_links.order', 'ASC')->get();
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function menuLinkTranslation(){
        return $this->hasMany(MenuLinkTranslation::class);
    }
}
