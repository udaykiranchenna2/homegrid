<x-core::button
    tag="a"
    data-bs-toggle="modal"
    data-bs-target="#home-grid-item-modal"
    :href="route('home-grid-item.create', ['home_grid_id' => BaseHelper::stringify($grid->id)])"
    icon="ti ti-plus"
>
    {{ trans('plugins/home-grid::home-grid.add_new') }}
</x-core::button>

<x-core::button
    type="button"
    icon="ti ti-device-floppy"
    class="btn-save-sort-order"
    data-url="{{ route('home-grid.sorting') }}"
    style="display: none;"
>
    {{ trans('plugins/home-grid::home-grid.save_sorting') }}
</x-core::button>