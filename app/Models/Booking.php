<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
     use HasFactory, SoftDeletes;
    protected $fillable = ['booker_id', 'room_id', 'book_date', 'end_date'];

    protected $dates = ['deleted_at'];
}

