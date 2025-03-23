<?php

namespace Botble\HomeGrid\Providers;

use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Supports\ServiceProvider;
use Botble\Shortcode\Compilers\Shortcode;
use Botble\Shortcode\Forms\ShortcodeForm;
use Botble\HomeGrid\Models\HomeGrid;
use Botble\Theme\Facades\Theme;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class HookServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (function_exists('shortcode')) {
            add_shortcode(
                'home-grid',
                trans('plugins/home-grid::home-grid.home_grid_shortcode_name'),
                trans('plugins/home-grid::home-grid.home_grid_shortcode_description'),
                [$this, 'render']
            );

            shortcode()->setPreviewImage(
                'home-grid',
                asset('core/plugins/home-grid/images/ui-blocks/home-grid.png')
            );

            shortcode()->setAdminConfig('home-grid', function (array $attributes) {
                return ShortcodeForm::createFromArray($attributes)
                    ->add(
                        'key',
                        SelectField::class,
                        SelectFieldOption::make()
                            ->label(trans('plugins/home-grid::home-grid.select_grid'))
                            ->choices(HomeGrid::query()
                                ->wherePublished()
                                ->pluck('name', 'key')
                                ->all())
                    );
            });
        }
    }

    public function render(Shortcode $shortcode): View|Factory|Application|null
    {
        $grid = HomeGrid::query()
            ->wherePublished()
            ->where('key', $shortcode->key)
            ->first();

        if (empty($grid) || $grid->gridItems->isEmpty()) {
            return null;
        }

        // Get the template name based on grid style
        $template = 'plugins/home-grid::styles.' . $grid->style;

        // Check if template exists, fallback to style-1 if it doesn't
        if (!view()->exists($template)) {
            $template = 'plugins/home-grid::styles.style-1';
        }

        return view($template, [
            'grid' => $grid,
            'items' => $grid->gridItems,
            'shortcode' => $shortcode,
        ]);
    }
}