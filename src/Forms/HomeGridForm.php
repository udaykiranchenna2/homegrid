<?php

namespace Botble\HomeGrid\Forms;

use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Base\Forms\FieldOptions\NameFieldOption;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\HomeGrid\Http\Requests\HomeGridRequest;
use Botble\HomeGrid\Models\HomeGrid;
use Botble\HomeGrid\Tables\HomeGridItemTable;
use Botble\Table\TableBuilder;

class HomeGridForm extends FormAbstract
{
    public function __construct(protected TableBuilder $tableBuilder)
    {
        parent::__construct();
    }

    public function setup(): void
    {
        $this
            ->model(HomeGrid::class)
            ->setValidatorClass(HomeGridRequest::class)
            ->add('name', TextField::class, NameFieldOption::make()->required())
            ->add(
                'key',
                TextField::class,
                TextFieldOption::make()
                    ->label(trans('plugins/home-grid::home-grid.key'))
                    ->required()
                    ->maxLength(120)
            )
            ->add('description', TextareaField::class, DescriptionFieldOption::make())
            ->add('style', SelectField::class, [
                'label' => trans('plugins/home-grid::home-grid.style'),
                'choices' => \Botble\HomeGrid\Support\HomeGridSupport::getStyles(),
            ])
            ->add('status', SelectField::class, StatusFieldOption::make())
            ->setBreakFieldPoint('status')
            ->when($this->model->id, function (): void {
                $this->addMetaBoxes([
                    'grid-items' => [
                        'title' => trans('plugins/home-grid::home-grid.grid_items'),
                        'content' => $this->tableBuilder->create(HomeGridItemTable::class)
                            ->setAjaxUrl(route(
                                'home-grid-item.index',
                                $this->getModel()->id ?: 0
                            ))
                            ->renderTable([
                                'home_grid_id' => $this->getModel()->getKey(),
                            ]),
                        'header_actions' => view('plugins/home-grid::partials.header-actions', [
                            'grid' => $this->getModel(),
                        ])->render(),
                        'has_table' => true,
                    ],
                ]);
            });
    }
}