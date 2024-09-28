<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'describe', 'quantity', 'price', 'image', 'manufacturer_id'];

    // Sản phẩm thuộc về một Manufacturer
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
}
