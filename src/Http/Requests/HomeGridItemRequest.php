<?php

namespace Botble\HomeGrid\Http\Requests;

use Botble\Support\Http\Requests\Request;

class HomeGridItemRequest extends Request
{
    public function rules(): array
    {
        return [
            'home_grid_id' => ['required', 'string'],
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'string'],
            'icon' => ['nullable', 'string'],
            'bg_color' => ['nullable', 'string', 'max:20'],
            'link' => ['nullable', 'string', 'max:255'],
            'button_text' => ['nullable', 'string', 'max:50'],
            'button_type' => ['nullable', 'string', 'max:20'],
            'button_color' => ['nullable', 'string', 'max:20'],
            'order' => ['required', 'integer', 'min:0', 'max:1000'],
        ];
    }
}