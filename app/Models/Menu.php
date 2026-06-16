<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    protected $fillable = [
        'location', 'parent_id', 'label', 'url', 'route_name',
        'icon', 'target', 'is_active', 'is_dropdown', 'sort_order',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'is_dropdown' => 'boolean',
        'sort_order'  => 'integer',
    ];

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')->orderBy('sort_order');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function resolvedUrl(): string
    {
        if ($this->route_name) {
            try {
                return route($this->route_name);
            } catch (\Throwable) {
                return $this->url ?? '#';
            }
        }
        return $this->url ?? '#';
    }

    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeForLocation($query, string $location)
    {
        return $query->where('location', $location)
            ->where('is_active', true)
            ->orderBy('sort_order');
    }
}
