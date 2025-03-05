<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Table extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_number',
        'capacity',
        'status',
        'location'
    ];

    protected $casts = [
        'capacity' => 'integer'
    ];

    const STATUSES = [
        'available' => 'Available',
        'occupied' => 'Occupied',
        'reserved' => 'Reserved',
        'maintenance' => 'Maintenance'
    ];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            'available' => 'bg-green-100 text-green-800',
            'occupied' => 'bg-red-100 text-red-800',
            'reserved' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
}
