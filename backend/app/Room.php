<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name', 'description', 'room_category', 'property_autor'
    ];

    public function getRoomCategory()
    {
        return $this->belongsTo(RoomCategory::class, 'room_category');
    }  

    public function getPropertyAutor()
    {
        return $this->belongsTo(Property::class, 'property_autor');
    }  
}
