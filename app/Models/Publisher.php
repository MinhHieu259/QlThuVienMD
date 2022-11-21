<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publisher extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = "_id";
    protected $fillable = [
        'name',
        'deleted',
    ];

    public function book() {
        return $this->hasMany(Book::class);
    }
}
