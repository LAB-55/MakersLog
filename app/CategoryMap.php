<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryMap extends Model
{
    protected $table = 'category_master';
    protected $fillable = [
    	'p_id',
    	'provider_id',
       	'c_name'
   ];
   public $timestamps = false;

}
