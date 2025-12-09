<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionsFactory> */
    use HasFactory;

    protected $primaryKey = 'transaction_id';
    public $incrementing = true;              
    protected $keyType = 'int';

    protected $fillable = [
        'booking_id',
        'booker_id',
        'room_id',
        'book_date',
        'end_date',
        'price_paid',
        'payment_method',
        'num_days',
    ];
    



    public function booker()
    {
        return $this->belongsTo(User::class, 'booker_id', 'id');
    }

    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id', 'room_id');
    }
}
