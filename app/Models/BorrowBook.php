<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class BorrowBook extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = "_id";
    protected $fillable = [
        'quantity',
        'borrowing_day',
        'borrowing_time',
        'return_day',
        'return_time',
        'status',
        'note',
        'user_id',
        'book_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

}
