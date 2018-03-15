<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class CollectionClear extends Model
{
    protected $table = 'collections';

    protected $fillable = ['id', 'order', 'parent', 'level', 'image', 'heroImage', 'heroImageMobile', 'publish'];

    public function product(){
        return $this->hasMany(Product::class);
    }
}
