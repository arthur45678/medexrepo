<?php

namespace App\Models\Samples;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class HealthSampleName extends Model
{
    protected $fillable = [
        'name',
        'relation',
        'route_name',
        'target'
    ];

    protected static function cacheKey(): string
    {
        return sprintf("%s", (new static)->getTable());
    }

    public static function getHealthSampleNames()
    {
        $value = Cache::rememberForever(self::cacheKey(), function () {
            return collect(HealthSampleName::get())->reduce(function ($hash, $item) {
                $hash[$item['relation']] = $item;
                return $hash;
            }, []);
        });
        return $value;
    }

    public static function getHealthSampleNamesArray()
    {
        $samples = HealthSampleName::getHealthSampleNames();
        return collect($samples)->toArray();
    }

    public static function getHealthSampleNamesGroupedByTarget(string $target)
    {
        $samples = HealthSampleName::getHealthSampleNames();
        $grouped = array_filter($samples, function ($sample) use ($target) {
            return $sample['target'] === $target &&
                $sample['relation'] !== 'stationaries' &&
                $sample['relation'] !== 'ambulator';
        });

        return array_values($grouped);
    }




    public static function forgetHealthSampleNameCache(): void
    {
        Cache::forget(self::cacheKey());
    }

    public static function boot(): void
    {
        parent::boot();

        self::creating(function ($item) {
            self::forgetHealthSampleNameCache();
            // Log::info('Creating event call:HealthSampleName - '.$item); // for testing
        });

        self::updating(function ($item) {
            self::forgetHealthSampleNameCache();
            // Log::info('Updating event call:HealthSampleName - '.$item); // for testing
        });
    }
}
