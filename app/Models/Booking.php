<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booker_id',
        'room_id',
        'book_date',
        'end_date',
        'room_price',
        'num_days',
    ];

    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id', 'room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'booker_id');
    }
}

