<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;

class Setting extends Model
{
    use Translatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */

    public $translatedAttributes = ['address', 'title', 'keywords', 'desc', 'footer'];

    protected $table = 'settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['phone1', 'phone2', 'email1', 'email2', 'facebook', 'twitter', 'instagram', 'pinterest', 'analytics', 'map', 'newsletter'];

}
