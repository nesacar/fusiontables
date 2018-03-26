<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Architect extends Model
{
    protected $fillable = ['name', 'city', 'country', 'phone', 'email', 'url', 'company', 'publish'];
}
