<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use File;

class Post extends Model
{
    use Translatable;

    public static $list_limit = 50;

    public $translatedAttributes = ['title', 'slug', 'short', 'body'];

    protected $table = 'posts';

    protected $fillable = ['id', 'user_id', 'category_id', 'image', 'publish', 'publish_at'];

    public static function base64UploadImage($post_id, $image){
        $post = self::find($post_id);
        if($post->image != null){
            File::delete($post->image);
        }
        $exploaded = explode(',', $image);
        $data = base64_decode($exploaded[1]);
        $filename = time() . '-' . $post->id . '.jpg';
        $path = public_path('uploads/posts/');
        file_put_contents($path . $filename, $data);
        $post->image = 'uploads/posts/' . $filename;
        $post->update();
        return $post->image;
    }

    public static function getPostLink($post){
        $category = Category::find($post->category_id);
        if(app()->getLocale() == 'en'){
            return url('it/' .$category->{"slug:it"} . '/' . $post->{"slug:it"} . '/' . $post->id);
        }else{
            return url('en/' .$category->{"slug:en"} . '/' . $post->{"slug:en"} . '/' . $post->id);
        }
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function photo(){
        return $this->hasMany(Photo::class);
    }
}
