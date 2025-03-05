<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;


class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'image_path',
        'is_vegetarian',
        'is_gluten_free',
        'is_featured',
        'status',
        'preparation_time',
        'calories'
    ];


    protected $casts = [
        'price' => 'decimal:2',
        'is_vegetarian' => 'boolean',
        'is_gluten_free' => 'boolean',
        'is_featured' => 'boolean',
        'preparation_time' => 'integer',
        'calories' => 'integer'
    ];

    protected $appends = [
        'image_url',
        'status_badge_color'
    ];

    // Relationships
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // Accessors
    public function getImageUrlAttribute(): string
    {
        return $this->image_path
            ? Storage::url($this->image_path)
            : asset('images/default-menu-item.jpg');
    }

    public function getStatusBadgeColorAttribute(): array
    {
        return match($this->status) {
            'active' => ['bg' => 'bg-green-100', 'text' => 'text-green-800'],
            'inactive' => ['bg' => 'bg-red-100', 'text' => 'text-red-800'],
            default => ['bg' => 'bg-gray-100', 'text' => 'text-gray-800'],
        };
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // Helper Methods
    public function isAvailable(): bool
    {
        return $this->status === 'active' && $this->availability === 'in_stock';
    }

    public function toggleStatus(): void
    {
        $this->status = $this->status === 'active' ? 'inactive' : 'active';
        $this->save();
    }

    public function toggleFeatured(): void
    {
        $this->is_featured = !$this->is_featured;
        $this->save();
    }

    public function getFormattedPrice(): string
    {
        return '$' . number_format($this->price, 2);
    }
    public function addons(): HasMany
    {
        return $this->hasMany(Addon::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

}
