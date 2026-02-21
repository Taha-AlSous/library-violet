<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaitingList extends Model
{
    protected $fillable = [
        'customer_id',
        'book_id',
    ];

    // العلاقة مع الكتاب
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // العلاقة مع الزبون
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}