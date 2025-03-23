<?php

namespace Botble\HomeGrid\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Models\BaseModel;

class HomeGridItem extends BaseModel
{
    protected $table = 'home_grid_items';

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image',
        'icon',
        'bg_color',
        'link',
        'button_text',
        'button_type',
        'button_color',
        'order',
        'home_grid_id',
    ];

    protected $casts = [
        'title' => SafeContent::class,
        'subtitle' => SafeContent::class,
        'description' => SafeContent::class,
        'link' => SafeContent::class,
        'button_text' => SafeContent::class,
    ];

    protected static function booted(): void
    {
        static::deleted(function (HomeGridItem $item): void {
            $item->metadata()->delete();
        });
    }
}