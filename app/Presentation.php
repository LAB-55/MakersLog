<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    protected $table = 'presentation';
    protected $fillable = [
       'id',
       'provider_id',
       'title',
       'presentation_name',
       'presentation_id',
       'presentation_url',
       'thumbnail_url'
   ];
}
