<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'description',
        'quantity',
        'unit',
        'price',
        'supplier',
        'expiry_date',
        'minimum_stock',
        'is_active'
    ];

    protected $casts = [
        'quantity' => 'float',
        'price' => 'decimal:2',
        'expiry_date' => 'date',
        'minimum_stock' => 'integer',
        'is_active' => 'boolean'
    ];

    public function getFormattedPriceAttribute(): string
    {
        return '₱' . number_format($this->price, 2);
    }

    public function isLowStock(): bool
    {
        return $this->quantity <= $this->minimum_stock;
    }

    public function isExpired(): bool
    {
        return $this->expiry_date && $this->expiry_date->isPast();
    }

    public function getStockStatusAttribute(): string
    {
        if ($this->isExpired()) {
            return 'expired';
        }
        if ($this->isLowStock()) {
            return 'low';
        }
        return 'normal';
    }
} 