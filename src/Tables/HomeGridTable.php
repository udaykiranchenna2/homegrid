<?php

namespace Botble\HomeGrid\Tables;

use Botble\Base\Facades\Html;
use Botble\HomeGrid\Models\HomeGrid;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\BulkActions\DeleteBulkAction;
use Botble\Table\BulkChanges\CreatedAtBulkChange;
use Botble\Table\BulkChanges\NameBulkChange;
use Botble\Table\BulkChanges\StatusBulkChange;
use Botble\Table\BulkChanges\TextBulkChange;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\FormattedColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\NameColumn;
use Botble\Table\Columns\StatusColumn;
use Botble\Table\HeaderActions\CreateHeaderAction;
use Illuminate\Database\Eloquent\Builder;

class HomeGridTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(HomeGrid::class)
            ->addHeaderAction(CreateHeaderAction::make()->route('home-grid.create'))
            ->addColumns([
                IdColumn::make(),
                NameColumn::make()->route('home-grid.edit'),
                FormattedColumn::make('key')
                    ->title(trans('plugins/home-grid::home-grid.key'))
                    ->alignStart()
                    ->getValueUsing(function (FormattedColumn $column) {
                        $value = $column->getItem()->key;

                        if (!function_exists('shortcode')) {
                            return $value;
                        }

                        return shortcode()->generateShortcode('home-grid', ['key' => $value]);
                    })
                    ->renderUsing(fn(FormattedColumn $column) => Html::tag('code', $column->getValue()))
                    ->copyable(),
                FormattedColumn::make('style')
                    ->title(trans('plugins/home-grid::home-grid.style'))
                    ->alignStart(),
                CreatedAtColumn::make(),
                StatusColumn::make(),
            ])
            ->addActions([
                EditAction::make()->route('home-grid.edit'),
                DeleteAction::make()->route('home-grid.destroy'),
            ])
            ->addBulkActions([
                DeleteBulkAction::make()->permission('home-grid.destroy'),
            ])
            ->addBulkChanges([
                NameBulkChange::make(),
                TextBulkChange::make()
                    ->name('key')
                    ->title(trans('plugins/home-grid::home-grid.key')),
                StatusBulkChange::make(),
                CreatedAtBulkChange::make(),
            ])
            ->queryUsing(function (Builder $query) {
                return $query
                    ->select([
                        'id',
                        'name',
                        'key',
                        'style',
                        'status',
                        'created_at',
                    ]);
            });
    }
}