<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'description', 'price',
        'image', 'available', 'is_veg', 'preparation_time', 'is_featured'
    ];

    protected $casts = [
        'price'            => 'decimal:2',
        'available'        => 'boolean',
        'is_veg'           => 'boolean',
        'is_featured'      => 'boolean',
        'preparation_time' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}