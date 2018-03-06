<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dimsav\Translatable\Translatable;
use File;

class Collection extends Model
{
    use Translatable;

    public static $list_limit = 50;

    public $translatedAttributes = ['title', 'slug', 'desc'];

    protected $table = 'collections';

    protected $fillable = ['id', 'order', 'parent', 'level', 'image', 'heroImage', 'heroImageMobile', 'publish'];

    public static function base64UploadImage($collection_id, $image){
        $collection = self::find($collection_id);
        if($collection->image != null){
            File::delete($collection->image);
        }
        $exploaded = explode(',', $image);
        $data = base64_decode($exploaded[1]);
        $filename = time() . '-' . $collection->id . '.jpg';
        $path = public_path('uploads/collections/');
        file_put_contents($path . $filename, $data);
        $collection->image = 'uploads/collections/' . $filename;
        $collection->update();
        return $collection->image;
    }

    public static function base64UploadHeroImage($collection_id, $image){
        $collection = self::find($collection_id);
        if($collection->image != null){
            File::delete($collection->heroImage);
        }
        $exploaded = explode(',', $image);
        $data = base64_decode($exploaded[1]);
        $filename = time() . '-' . $collection->id . '.jpg';
        $path = public_path('uploads/collections/');
        file_put_contents($path . $filename, $data);
        $collection->heroImage = 'uploads/collections/' . $filename;
        $collection->update();
        return $collection->image;
    }

    public static function base64UploadHeroImageMobile($collection_id, $image){
        $collection = self::find($collection_id);
        if($collection->image != null){
            File::delete($collection->heroImageMobile);
        }
        $exploaded = explode(',', $image);
        $data = base64_decode($exploaded[1]);
        $filename = time() . '-' . $collection->id . '.jpg';
        $path = public_path('uploads/collections/');
        file_put_contents($path . $filename, $data);
        $collection->heroImageMobile = 'uploads/collections/' . $filename;
        $collection->update();
        return $collection->image;
    }

    public static function getCollectionLink($slug){
        if(app()->getLocale() == 'en'){
            return url('it/collezioni/'.$slug);
        }else{
            return url('en/collections/'.$slug);
        }
    }

    public static function getParentCollectionLink($slug1, $slug2){
        if(app()->getLocale() == 'en'){
            return url('it/collezioni/'.$slug1.'/'.$slug2);
        }else{
            return url('en/collections/'.$slug1.'/'.$slug2);
        }
    }

    public function product(){
        return $this->hasMany(Product::class);
    }
}
