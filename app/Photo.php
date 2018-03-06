<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use File;

class Photo extends Model
{
    protected $fillable = ['product_id', 'file_name', 'file_path', 'file_path_small', 'publish'];

    public static function saveImage($product_id, $image){
        $product = Product::find($product_id);
        $folderName = $product->{'slug:en'} . '-' . $product->id;
        $folderPath = public_path('uploads/galleries/' . $folderName);
        if(!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0775, true, true);
            if(!File::exists($folderPath . '/tmb')) {
                File::makeDirectory($folderPath . '/tmb', 0775, true, true);
            }
        }

        if(isset($image)){
            $imageName = $folderName . '-' . time() . str_random(15) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/galleries/'.$folderName.'/'.$imageName;
            $imagePathTmb = 'uploads/galleries/'.$folderName.'/tmb/'.$imageName;
            $image->move(public_path('/uploads/galleries/' . $folderName . '/'), $imageName);
            File::copy(public_path('/uploads/galleries/' . $folderName . '/'. $imageName), public_path('/uploads/galleries/' . $folderName . '/tmb/'. $imageName));

            self::cropImage($imagePathTmb, 150);

            $photo = new Photo();
            $photo->product_id = $product_id;
            $photo->file_name = $imageName;
            $photo->file_path = $imagePath;
            $photo->file_path_small = $imagePathTmb;
            $photo->publish = 1;
            $photo->save();
        }

        return 'done';

    }

    public static function cropImage($image, $width){
        \Image::make($image)->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($image);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
