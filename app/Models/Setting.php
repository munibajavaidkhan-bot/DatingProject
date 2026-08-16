<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key', 'value', 'type', 'group', 'label', 'description',
    ];

    /**
     * Get a setting value by key
     */
    public static function get(string $key, $default = null)
    {
        $setting = Cache::remember("setting_{$key}", 3600, function () use ($key) {
            return static::where('key', $key)->first();
        });

        if (!$setting) {
            return $default;
        }

        return $setting->castValue();
    }

    /**
     * Set a setting value
     */
    public static function set(string $key, $value): void
    {
        $setting = static::where('key', $key)->first();

        if ($setting) {
            $setting->update(['value' => $value]);
        } else {
            static::create(['key' => $key, 'value' => $value]);
        }

        Cache::forget("setting_{$key}");
    }

    /**
     * Check if a feature is enabled
     */
    public static function isEnabled(string $key): bool
    {
        return (bool) static::get($key, true);
    }

    /**
     * Cast value based on type
     */
    protected function castValue()
    {
        return match ($this->type) {
            'boolean' => (bool) $this->value,
            'number'  => (int) $this->value,
            'json'    => json_decode($this->value, true),
            default   => $this->value,
        };
    }
}
