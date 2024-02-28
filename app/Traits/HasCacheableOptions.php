<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Schema;

use DB;

trait HasCacheableOptions
{
    protected static $rememberCacheFor = 86400;

    /**
     * Get the unique cache key for current model - its table name
     *
     * @return string
     */
    protected static function cacheKey(): string
    {
        return sprintf("%s", (new static)->getTable());
    }

    /**
     * Get the 2 columns to select as LABEL and VALUE for HTML <select>
     *
     * @return array
     */
    protected static function getColumnsForOptions(): array
    {
        return ["id as value", DB::raw("CONCAT(code, ' ', name) as label")];
    }

    /**
     * Flush the cached data
     *
     * @return void
     */
    public static function flushOptionsCache(): void
    {
        Cache::forget(static::cacheKey());
    }

    public static function boot(): void
    {
        parent::boot();

        // Delete cache after any change in model. Note that this function may conflict with other traits!!

        self::creating(function () {
            self::flushOptionsCache();
        });

        self::updating(function () {
            self::flushOptionsCache();
        });
    }

    /**
     * Returns data, as pairs of LABEL, VALUE
     *
     * @return lluminate\Database\Eloquent\Collection
     */
    public static function jsonOptions(): Collection
    {
        return Cache::remember(self::cacheKey(), self::$rememberCacheFor, function () {

            $table_name = (new static)->getTable();
            $isStatusExist = Schema::hasColumn($table_name, 'status');
            return self::select(self::getColumnsForOptions())->when($isStatusExist, function($q) {
                return $q->where('status', '=', 'active');
            })->get();
        });
    }

    /**
     * Search and get the data from collection returned by jsonOptions
     *
     * @param string $query
     * @return array
     */
    public function search(string $query): array
    {
        if ($query === "") return $this->jsonOptions()->toArray();

        return array_values($this->jsonOptions()->filter(function ($item) use ($query) {
            // return (stripos($item->label, $query) !== false);
            return preg_match("/$query/i", $item->label); // case insensitive-search
        })->toArray());
    }

    /**
     * Get the code and name attributes concatenated
     *
     * @return string
     */
    public function getCodeNameAttribute(): string
    {
        return $this->attributes['code'] . " " . $this->attributes['name'];
    }
}
