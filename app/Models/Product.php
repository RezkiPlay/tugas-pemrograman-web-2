<?php

namespace App\Models;

use App\Models\Category; // ← tambahan
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['category_id', 'supplier_id', 'name', 'brand', 'price', 'stock', 'description', 'unit'])]
class Product extends Model
{
    use HasFactory, SoftDeletes; // ← tambahkan SoftDeletes

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}