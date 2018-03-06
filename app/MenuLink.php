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

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
