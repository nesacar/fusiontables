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
}
