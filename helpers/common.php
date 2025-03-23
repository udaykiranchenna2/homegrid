<?php

use Botble\HomeGrid\Models\HomeGrid;
use Illuminate\Database\Eloquent\Collection;

if (!function_exists('get_all_home_grids')) {
    function get_all_home_grids(array $condition = []): Collection
    {
        return HomeGrid::query()->where($condition)->get();
    }
}

if (!function_exists('get_home_grid_by_key')) {
    function get_home_grid_by_key(string $key): ?HomeGrid
    {
        return HomeGrid::query()
            ->where('key', $key)
            ->wherePublished()
            ->first();
    }
}