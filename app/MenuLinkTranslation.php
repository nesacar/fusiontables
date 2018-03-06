<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuLinkTranslation extends Model
{
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menu_link_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'link', 'desc', 'sufix'];
}
