<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectionTranslation extends Model
{
    public $timestamps = false;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'collection_translations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'desc'];
}
