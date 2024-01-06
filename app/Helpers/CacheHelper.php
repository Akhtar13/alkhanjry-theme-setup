<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use App\Models\Region;

class CacheHelper
{
    public static function region()
    {
        if (!Cache::has('region_cache')) {
            $regions = Region::where('status', 'active')->get();
            Cache::put('region_cache', $regions);
        }
        return Cache::get('region_cache');
    }
}