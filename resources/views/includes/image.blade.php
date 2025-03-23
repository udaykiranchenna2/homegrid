@php
    $item->loadMissing('metadata');
    $tabletImage = $item->getMetaData('tablet_image', true) ?: $item->image;
    $mobileImage = $item->getMetaData('mobile_image', true) ?: $tabletImage;

    $attributes = $attributes ?? [];

    $lazy = true;

    if (Arr::get($attributes, 'loading') !== 'lazy') {
        $lazy = false;
    }
@endphp

<picture>
    <source srcset="{{ RvMedia::getImageUrl($item->image, null, false, RvMedia::getDefaultImage()) }}" media="(min-width: 1200px)" />
    <source srcset="{{ RvMedia::getImageUrl($tabletImage, null, false, RvMedia::getDefaultImage()) }}" media="(min-width: 768px)" />
    <source srcset="{{ RvMedia::getImageUrl($mobileImage, null, false, RvMedia::getDefaultImage()) }}" media="(max-width: 767px)" />
    {{ RvMedia::image($item->image, attributes: $attributes, lazy: $lazy) }}
</picture>