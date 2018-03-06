<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use File;

class Product extends Model
{
    use Translatable;

    public static $list_limit = 50;

    public $translatedAttributes = ['title', 'slug', 'short', 'body', 'body2'];

    protected $table = 'products';

    protected $fillable = ['id', 'user_id', 'collection_id', 'order', 'parent', 'level', 'image', 'price_small', 'price_outlet', 'publish', 'publish_at'];

    public static function base64UploadImage($product_id, $image){
        $product = self::find($product_id);
        if($product->image != null){
            File::delete($product->image);
        }
        $exploaded = explode(',', $image);
        $data = base64_decode($exploaded[1]);
        $filename = time() . '-' . $product->id . '.jpg';
        $path = public_path('uploads/products/');
        file_put_contents($path . $filename, $data);
        $product->image = 'uploads/products/' . $filename;
        $product->update();
        return $product->image;
    }

    public static function getProductLink($product){
        $collection = Collection::find($product->collection_id);
        if($collection->parent == 0){
            return url($collection->slug . '/' . $product->slug . '/' . $product->id);
        }else{
            $parent = Collection::find($collection->parent);
            return url($parent->slug . '/' . $collection->slug . '/' . $product->slug . '/' . $product->id);
        }
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function collection(){
        return $this->belongsTo(Collection::class);
    }

    public function photo(){
        return $this->hasMany(Photo::class);
    }
}
