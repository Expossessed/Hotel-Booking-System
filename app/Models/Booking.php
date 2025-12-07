<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model

    
{
    use HasFactory;
    /**
     * The primary key associated with the table.
     */
    protected $primaryKey = 'booking_id';

    /**
     * The "type" of the primary key ID.
     */
    protected $keyType = 'int';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = true;

    protected $fillable = [
        'booker_id',
        'room_id',
        'book_date',
        'end_date',
        'room_price',
        'num_days',
        'total',
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

