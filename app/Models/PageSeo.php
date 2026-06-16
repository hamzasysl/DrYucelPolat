<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSeo extends Model
{
    protected $table = 'page_seos';

    protected $fillable = [
        'page_key', 'label', 'title', 'description', 'keywords',
        'og_title', 'og_description', 'og_image', 'canonical',
        'robots', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public static function forKey(string $key): ?self
    {
        return self::query()->where('page_key', $key)->first();
    }

    public function isIndexable(): bool
    {
        return str_contains(strtolower($this->robots ?? ''), 'index')
            && ! str_contains(strtolower($this->robots ?? ''), 'noindex');
    }
}
