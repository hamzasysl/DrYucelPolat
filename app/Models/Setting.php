<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'group', 'type', 'label'];

    public static function get(string $key, mixed $default = null): mixed
    {
        return Cache::rememberForever("setting:{$key}", function () use ($key, $default) {
            $row = self::query()->where('key', $key)->first();
            return $row?->value ?? $default;
        });
    }

    public static function set(string $key, mixed $value, string $group = 'general', string $type = 'text', ?string $label = null): self
    {
        $row = self::query()->updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
                'type'  => $type,
                'label' => $label,
            ]
        );
        Cache::forget("setting:{$key}");
        return $row;
    }

    public static function bulkSet(array $items): void
    {
        foreach ($items as $key => $value) {
            self::set($key, $value);
        }
    }

    public static function getGroup(string $group): array
    {
        return self::query()->where('group', $group)->pluck('value', 'key')->all();
    }

    public static function clearCache(): void
    {
        Cache::flush();
    }
}
