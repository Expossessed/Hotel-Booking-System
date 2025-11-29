<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    /** @use HasFactory<\Database\Factories\RoomReviewsFactory> */
    use HasFactory;

    protected $fillable = [
        'room_id',
        'user_id',
        'rating',
        'comment',
    ];

    public function room()
    {
        // Rooms model uses a non-standard primary key (room_id)
        // so we must declare the owner key explicitly.
        return $this->belongsTo(Rooms::class, 'room_id', 'room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}