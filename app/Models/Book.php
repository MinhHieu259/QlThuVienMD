<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = "_id";
    protected $fillable = [
        'name',
        'year_publisher',
        'image',
        'note',
        'deleted',
        'category_id',
        'publisher_id',
        'author_id'
    ];


    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getImageUrlAttribute() {
        if($this->image && Storage::disk('images')->exists($this->image)) {
            if($this->image) {
                return Storage::disk('images')->url($this->image);
            }
        }
        return asset('storage/no-image.png');
    }
}
