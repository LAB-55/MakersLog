<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'post_master';
    protected $fillable = [
       'p_id',
       'rand_id',
       'provider_id',
       'p_content',
       'p_short_dec',
       'p_title',
       'categories',
       'uri',
       'is_latest',
       'delete'
   ];
}
