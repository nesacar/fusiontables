<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';

    protected $fillable = ['name', 'fullname', 'locale', 'publish'];

    public static function setPrimary($language_id){
        $languages = Language::get();
        if(count($languages)>0){
            foreach ($languages as $language){
                if($language->id == $language_id){
                    $language->primary = 1;
                }else{
                    $language->primary = 0;
                }
                $language->update();
            }
        }
        return true;
    }

    public static function getPrimary(){
        return self::where('primary', 1)->first();
    }

    public function subscriber(){
        return $this->hasMany(Subscriber::class);
    }

    public function newsletter(){
        return $this->hasMany('App\Newsletter');
    }
}
