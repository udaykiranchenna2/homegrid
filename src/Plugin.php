<?php

namespace Botble\HomeGrid;

use Illuminate\Support\Facades\Schema;
use Botble\PluginManagement\Abstracts\PluginOperationAbstract;

class Plugin extends PluginOperationAbstract
{
    public static function remove(): void
    {
        Schema::dropIfExists('Home_grids');
        Schema::dropIfExists('Home_grid_items');
    }
}
