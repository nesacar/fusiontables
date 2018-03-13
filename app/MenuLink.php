<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class MenuLink extends Model
{
    use Translatable;

    protected $table = 'menu_links';

    public $translatedAttributes = ['title', 'link', 'desc', 'sufix'];

    protected $fillable = ['id', 'menu_id', 'category_id', 'type', 'order', 'parent', 'level', 'publish'];

    public static function getNoParentLinksById($id, $locale='sr'){
        return self::select('menu_links.id as id', 'menu_link_translations.link as link', 'menu_link_translations.title as title')
            ->join('menu_link_translations', 'menu_links.id', '=', 'menu_link_translations.menu_link_id')
            ->join('menus', 'menu_links.menu_id', '=', 'menus.id')
            ->where('menus.id', $id)->where('menu_link_translations.locale', $locale)->where('menu_links.parent', 0)->where('menu_links.publish', 1)
            ->orderBy('menu_links.order', 'ASC')->get();
    }

    public function getLinkAttribute()
    {
        return $this->translate()->link;
    }
    public function getTitleAttribute()
    {
        return $this->translate()->title;
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function menuLinkTranslation(){
        return $this->hasMany(MenuLinkTranslation::class);
    }
}
