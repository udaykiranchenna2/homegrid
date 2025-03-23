<?php

return [
    [
        'name' => 'Home Grids',
        'flag' => 'home-grid.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'home-grid.create',
        'parent_flag' => 'home-grid.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'home-grid.edit',
        'parent_flag' => 'home-grid.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'home-grid.destroy',
        'parent_flag' => 'home-grid.index',
    ],

    [
        'name' => 'Home Grid Items',
        'flag' => 'home-grid-item.index',
    ],
    [
        'name' => 'Create',
        'flag' => 'home-grid-item.create',
        'parent_flag' => 'home-grid-item.index',
    ],
    [
        'name' => 'Edit',
        'flag' => 'home-grid-item.edit',
        'parent_flag' => 'home-grid-item.index',
    ],
    [
        'name' => 'Delete',
        'flag' => 'home-grid-item.destroy',
        'parent_flag' => 'home-grid-item.index',
    ],
];