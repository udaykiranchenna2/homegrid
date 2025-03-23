<?php

namespace Botble\HomeGrid\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Facades\PanelSectionManager;
use Botble\Base\PanelSections\PanelSectionItem;
use Botble\Base\Supports\DashboardMenuItem;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Language\Facades\Language;
use Botble\HomeGrid\Models\HomeGrid;
use Botble\HomeGrid\Models\HomeGridItem;
use Botble\HomeGrid\Support\HomeGridSupport;

class HomeGridServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register(): void
    {
        $this->app->bind(Repositories\Interfaces\HomeGridInterface::class, function () {
            return new Repositories\Eloquent\HomeGridRepository(new Models\HomeGrid());
        });

        $this->app->bind(Repositories\Interfaces\HomeGridItemInterface::class, function () {
            return new Repositories\Eloquent\HomeGridItemRepository(new Models\HomeGridItem());
        });
    }

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/home-grid')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions'])
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadRoutes()
            ->loadMigrations()
            ->publishAssets();

        DashboardMenu::default()->beforeRetrieving(function (): void {
            DashboardMenu::make()
                ->registerItem(
                    DashboardMenuItem::make()
                        ->id('cms-plugins-home-grid')
                        ->priority(390)
                        ->name('plugins/home-grid::home-grid.menu')
                        ->icon('ti ti-layout-grid')
                        ->route('home-grid.index')
                );
        });

        if (defined('LANGUAGE_MODULE_SCREEN_NAME') && defined('LANGUAGE_ADVANCED_MODULE_SCREEN_NAME')) {
            Language::registerModule(HomeGrid::class);
        }

        $this->app->booted(function (): void {
            $this->app->register(HookServiceProvider::class);

            // Register responsive image sizes
            HomeGridSupport::registerResponsiveImageSizes();
        });
    }
}