<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['gallery_id', 'file_name', 'file_path', 'file_path_small', 'order', 'publish'];

    public function gallery(){
        return $this->belongsTo(Gallery::class);
    }
}
