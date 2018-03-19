<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class ProductClear extends Model
{

    protected $table = 'products';

    protected $fillable = ['id', 'user_id', 'collection_id', 'order', 'parent', 'level', 'image', 'price_small', 'price_outlet', 'publish', 'publish_at'];

    public static function getProductByCollectionId($collection_id){
        return self::select('products.*', 'product_translations.slug as slug', 'product_translations.title as title')->join('product_translations', 'products.id', '=', 'product_translations.product_id')
            ->join('collections', 'products.collection_id', '=', 'collections.id')
            ->where('products.collection_id', $collection_id)->where('products.publish', 1)->orderBy('products.order', 'ASC')->get();
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
