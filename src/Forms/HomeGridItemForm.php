<?php

namespace Botble\HomeGrid\Forms;

use Botble\Base\Forms\FieldOptions\DescriptionFieldOption;
use Botble\Base\Forms\FieldOptions\MediaImageFieldOption;
use Botble\Base\Forms\FieldOptions\SortOrderFieldOption;
use Botble\Base\Forms\Fields\ColorField;
use Botble\Base\Forms\Fields\CoreIconField;
use Botble\Base\Forms\Fields\IconField;
use Botble\Base\Forms\Fields\MediaImageField;
use Botble\Base\Forms\Fields\NumberField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Forms\FormAbstract;
use Botble\HomeGrid\Http\Requests\HomeGridItemRequest;
use Botble\HomeGrid\Models\HomeGridItem;

class HomeGridItemForm extends FormAbstract
{
    public function setup(): void
    {
        $this
            ->model(HomeGridItem::class)
            ->setValidatorClass(HomeGridItemRequest::class)
            ->contentOnly()
            ->add('home_grid_id', 'hidden', [
                'value' => $this->getRequest()->input('home_grid_id'),
            ])
            ->add('title', TextField::class, [
                'label' => trans('core/base::forms.title'),
                'attr' => [
                    'data-counter' => 120,
                ],
            ])
            ->add('subtitle', TextField::class, [
                'label' => trans('plugins/home-grid::home-grid.subtitle'),
                'attr' => [
                    'data-counter' => 120,
                ],
            ])
            ->add('description', TextareaField::class, DescriptionFieldOption::make())
            ->add('link', TextField::class, [
                'label' => trans('core/base::forms.link'),
                'attr' => [
                    'placeholder' => 'https://',
                    'data-counter' => 120,
                ],
            ])
            ->add('button_text', TextField::class, [
                'label' => trans('plugins/home-grid::home-grid.button_text'),
                'attr' => [
                    'data-counter' => 120,
                ],
            ])
            ->add('button_type', SelectField::class, [
                'label' => trans('plugins/home-grid::home-grid.button_type'),
                'choices' => \Botble\HomeGrid\Support\HomeGridSupport::getButtonTypes(),
            ])
            ->add('button_color', ColorField::class, [
                'label' => trans('plugins/home-grid::home-grid.button_color'),
                'attr' => [
                    'placeholder' => '#ffffff',
                ],
            ])
            ->add('bg_color', ColorField::class, [
                'label' => trans('plugins/home-grid::home-grid.bg_color'),
                'attr' => [
                    'placeholder' => '#ffffff',
                ],
            ])
            ->add('icon', CoreIconField::class, [
                'label' => trans('plugins/home-grid::home-grid.icon'),
            ])
            ->add('order', NumberField::class, SortOrderFieldOption::make())
            ->add('image', MediaImageField::class, MediaImageFieldOption::make());
    }
}