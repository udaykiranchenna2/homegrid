<?php

namespace Botble\HomeGrid\Tables;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\Html;
use Botble\HomeGrid\Models\HomeGridItem;
use Botble\Table\Abstracts\TableAbstract;
use Botble\Table\Actions\DeleteAction;
use Botble\Table\Actions\EditAction;
use Botble\Table\Columns\Column;
use Botble\Table\Columns\CreatedAtColumn;
use Botble\Table\Columns\FormattedColumn;
use Botble\Table\Columns\IdColumn;
use Botble\Table\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;

class HomeGridItemTable extends TableAbstract
{
    public function setup(): void
    {
        $this
            ->model(HomeGridItem::class)
            ->setView('plugins/home-grid::items')
            ->setDom($this->simpleDom())
            ->addColumns([
                IdColumn::make(),
                ImageColumn::make(),
                FormattedColumn::make('title')
                    ->title(trans('core/base::tables.title'))
                    ->alignStart()
                    ->getValueUsing(function (FormattedColumn $column) {
                        $item = $column->getItem();

                        $name = BaseHelper::clean($item->title);

                        if (!$this->hasPermission('home-grid-item.edit')) {
                            return $name;
                        }

                        return $name ? Html::link(route('home-grid-item.edit', $item->getKey()), $name, [
                            'data-bs-toggle' => 'modal',
                            'data-bs-target' => '#home-grid-item-modal',
                        ]) : '&mdash;';
                    }),
                FormattedColumn::make('subtitle')
                    ->title(trans('plugins/home-grid::home-grid.subtitle'))
                    ->alignStart(),
                FormattedColumn::make('button_text')
                    ->title(trans('plugins/home-grid::home-grid.button_text'))
                    ->alignStart(),
                Column::make('order')
                    ->title(trans('core/base::tables.order'))
                    ->className('text-start order-column'),
                CreatedAtColumn::make(),
            ])
            ->addActions([
                EditAction::make()
                    ->route('home-grid-item.edit')
                    ->attributes([
                        'data-bs-toggle' => 'modal',
                        'data-bs-target' => '#home-grid-item-modal',
                    ])
                    ->permission('home-grid-item.edit'),
                DeleteAction::make()
                    ->route('home-grid-item.destroy')
                    ->permission('home-grid-item.destroy'),
            ])
            ->queryUsing(function (Builder $query) {
                return $query
                    ->select([
                        'id',
                        'title',
                        'subtitle',
                        'image',
                        'button_text',
                        'order',
                        'created_at',
                    ])
                    ->oldest('order')
                    ->where('home_grid_id', request()->route()->parameter('id'));
            });
    }
}