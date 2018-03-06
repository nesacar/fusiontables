<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use File;

class Category extends Model
{
    use Translatable;

    public static $list_limit = 50;

    public $translatedAttributes = ['title', 'slug', 'desc'];

    protected $table = 'categories';

    protected $fillable = ['id', 'order', 'parent', 'level', 'image', 'publish'];

    public static function base64UploadImage($category_id, $image){
        $category = self::find($category_id);
        if($category->image != null){
            File::delete($category->image);
        }
        $exploaded = explode(',', $image);
        $data = base64_decode($exploaded[1]);
        $filename = time() . '-' . $category->id . '.jpg';
        $path = public_path('uploads/categories/');
        file_put_contents($path . $filename, $data);
        $category->image = 'uploads/categories/' . $filename;
        $category->update();
        return $category->image;
    }

    public function post(){
        return $this->hasMany(Post::class);
    }
}
