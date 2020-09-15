<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'name', 'description', 'category_property', 'valoration', 'location', 'location_description', 'user_autor'
    ];
}
