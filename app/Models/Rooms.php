<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    /** @use HasFactory<\\Database\\Factories\\ProductFactory> */
    use HasFactory;

    // The actual primary key used around the app is room_id
    protected $primaryKey = 'room_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['room_type', 'room_desc', 'room_price', 'image_link', 'available_rooms', 'is_available'];
}
