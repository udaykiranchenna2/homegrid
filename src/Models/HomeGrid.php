<?php

namespace Botble\HomeGrid\Models;

use Botble\Base\Casts\SafeContent;
use Botble\Base\Enums\BaseStatusEnum;
use Botble\Base\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeGrid extends BaseModel
{
    protected $table = 'home_grids';

    protected $fillable = [
        'name',
        'key',
        'description',
        'style',
        'status',
    ];

    protected $casts = [
        'status' => BaseStatusEnum::class,
        'name' => SafeContent::class,
        'key' => SafeContent::class,
        'description' => SafeContent::class,
    ];

    protected static function booted(): void
    {
        static::deleted(function (HomeGrid $grid): void {
            $grid->gridItems()->each(fn(HomeGridItem $item) => $item->delete());
        });
    }

    public function gridItems(): HasMany
    {
        return $this->hasMany(HomeGridItem::class)->orderBy('home_grid_items.order');
    }
}