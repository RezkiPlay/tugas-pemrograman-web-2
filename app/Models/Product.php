<?php

namespace App\Models;

use App\Models\Category; // ← tambahan
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['category_id', 'name', 'price', 'stock', 'description', 'unit'])] // ← tambah category_id
class Product extends Model
{
    use HasFactory;

    public function category() // ← tambahan
    {
        return $this->belongsTo(Category::class);
    }
}