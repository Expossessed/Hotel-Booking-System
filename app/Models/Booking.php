<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booker_id',
        'room_id',
        'book_date',
        'end_date',
        'room_price',
        'num_days',
    ];

    protected $dates = ['deleted_at'];
}

