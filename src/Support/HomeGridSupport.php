<?php

namespace Botble\HomeGrid\Support;

use Botble\HomeGrid\Forms\HomeGridItemForm;

class HomeGridSupport
{
    public static function registerResponsiveImageSizes(): void
    {
        HomeGridItemForm::extend(function (HomeGridItemForm $form) {
            $form
                ->addAfter('image', 'tablet_image', 'mediaImage', [
                    'label' => __('Tablet Image'),
                    'help_block' => [
                        'text' => __(
                            'For devices with width from 768px to 1200px, if empty, will use the image from the desktop.'
                        ),
                    ],
                    'metadata' => true,
                ])
                ->addAfter('tablet_image', 'mobile_image', 'mediaImage', [
                    'label' => __('Mobile Image'),
                    'help_block' => [
                        'text' => __(
                            'For devices with width less than 768px, if empty, will use the image from the tablet.'
                        ),
                    ],
                    'metadata' => true,
                ]);

            return $form;
        }, 127);
    }

    public static function getStyles(): array
    {
        return [
            'style-1' => __('Style 1 - Basic Grid'),
            'style-2' => __('Style 2 - Card Style'),
            'style-3' => __('Style 3 - Image Overlay'),
            'style-4' => __('Style 4 - Full Page Grid'),
            'style-5' => __('Style 5 - Five Grid Layout'),
        ];
    }

    public static function getButtonTypes(): array
    {
        return [
            'primary' => __('Primary'),
            'secondary' => __('Secondary'),
            'success' => __('Success'),
            'danger' => __('Danger'),
            'warning' => __('Warning'),
            'info' => __('Info'),
            'light' => __('Light'),
            'dark' => __('Dark'),
            'link' => __('Link'),
        ];
    }
}