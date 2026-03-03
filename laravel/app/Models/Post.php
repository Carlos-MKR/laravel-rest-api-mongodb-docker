<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'posts';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'category_id',
        'date'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
