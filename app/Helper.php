<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    public static function getHomeLink(){
        if(app()->getLocale() == 'en'){
            return url('it');
        }else{
            return url('en');
        }
    }

    public static function removePTag($str=""){
        $str = str_replace('<p>', '', $str);
        $str = str_replace('</p>', '', $str);
        return $str;
    }

    public static function getRoute(){
        return \Request::path();
    }
}
