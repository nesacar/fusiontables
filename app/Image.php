<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use File;

class Image extends Model
{
    protected $fillable = ['gallery_id', 'file_name', 'file_path', 'file_path_small', 'order', 'publish'];

    public static function saveImage($gallery_id, $image){
        $gallery = Gallery::find($gallery_id);
        $folderName = $gallery->slug . '-' . $gallery->id;
        $folderPath = public_path('uploads/images/' . $folderName);
        if(!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0775, true, true);
            if(!File::exists($folderPath . '/tmb')) {
                File::makeDirectory($folderPath . '/tmb', 0775, true, true);
            }
        }

        if(isset($image)){
            $imageName = $folderName . '-' . time() . str_random(15) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'uploads/images/'.$folderName.'/'.$imageName;
            $imagePathTmb = 'uploads/images/'.$folderName.'/tmb/'.$imageName;
            $image->move(public_path('/uploads/images/' . $folderName . '/'), $imageName);
            File::copy(public_path('/uploads/images/' . $folderName . '/'. $imageName), public_path('/uploads/images/' . $folderName . '/tmb/'. $imageName));

            self::cropImage($imagePathTmb, 226);

            $image = new Image();
            $image->gallery_id = $gallery_id;
            $image->file_name = $imageName;
            $image->file_path = $imagePath;
            $image->file_path_small = $imagePathTmb;
            $image->publish = 1;
            $image->save();
        }

        return 'done';

    }

    public static function cropImage($image, $width){
        \Image::make($image)->resize($width, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($image);
    }

    public function gallery(){
        return $this->belongsTo(Gallery::class);
    }
}
