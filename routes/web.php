<?php

use Botble\Base\Facades\AdminHelper;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Botble\HomeGrid\Http\Controllers'], function (): void {
    AdminHelper::registerRoutes(function (): void {
        Route::group(['prefix' => 'home-grids', 'as' => 'home-grid.'], function (): void {
            Route::resource('', 'HomeGridController')->parameters(['' => 'homeGrid']);

            Route::post('sorting', [
                'as' => 'sorting',
                'uses' => 'HomeGridController@postSorting',
                'permission' => 'home-grid.edit',
            ]);
        });

        Route::group(['prefix' => 'home-grid-items', 'as' => 'home-grid-item.'], function (): void {
            Route::resource('', 'HomeGridItemController')->except([
                'index',
            ])->parameters(['' => 'home-grid-item']);

            Route::match(['GET', 'POST'], 'list/{id}', [
                'as' => 'index',
                'uses' => 'HomeGridItemController@index',
            ])->wherePrimaryKey();
        });
    });
});