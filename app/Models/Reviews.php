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
        return $this->belongsTo(Rooms::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}