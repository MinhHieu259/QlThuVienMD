<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Roles extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = "_id";
    protected $fillable = [
        'name'
    ];

    public function user() {
        return $this->hasMany(User::class);
    }
}
