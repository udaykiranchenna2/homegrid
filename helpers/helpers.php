<?php

use Botble\Base\Enums\BaseStatusEnum;
use Botble\HomeGrid\Models\HomeGrid;

if (!function_exists('get_home_grid')) {
    /**
     * Get home grid by ID
     * 
     * @param int $id
     * @return HomeGrid|null
     */
    function get_home_grid(int $id)
    {
        return HomeGrid::query()
            ->where('id', $id)
            ->where('status', BaseStatusEnum::PUBLISHED)
            ->with([
                'items' => function ($query) {
                    $query->where('status', BaseStatusEnum::PUBLISHED)
                        ->orderBy('order');
                }
            ])
            ->first();
    }
}

if (!function_exists('get_featured_home_grid')) {
    /**
     * Get the featured home grid defined in theme options
     * 
     * @return HomeGrid|null
     */
    function get_featured_home_grid()
    {
        $featuredGridId = theme_option('featured_home_grid');

        if (!$featuredGridId) {
            return null;
        }

        return get_home_grid($featuredGridId);
    }
}

if (!function_exists('render_home_grid')) {
    /**
     * Render a home grid by ID
     * 
     * @param int $id
     * @return string
     */
    function render_home_grid(int $id): string
    {
        $homeGrid = get_home_grid($id);

        if (!$homeGrid) {
            return '';
        }

        return view('plugins/home-grid::partials.' . $homeGrid->style, compact('homeGrid'))->render();
    }
}

// Add these constants to avoid "magic string" issues
if (!defined('HOME_GRID_MODULE_SCREEN_NAME')) {
    define('HOME_GRID_MODULE_SCREEN_NAME', 'home-grid');
}

if (!defined('HOME_GRID_ITEM_MODULE_SCREEN_NAME')) {
    define('HOME_GRID_ITEM_MODULE_SCREEN_NAME', 'home-grid-item');
}