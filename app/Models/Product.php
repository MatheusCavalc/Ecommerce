<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'category_id', 'image', 'description', 'price', 'published', 'created_by', 'updated_by', 'deleted_by'];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
