<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['title', 'slug', 'order', 'publish'];

    public function image(){
        return $this->hasMany(Image::class);
    }
}
