<?php

namespace Botble\HomeGrid\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class HomeGridRequest extends Request
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:250'],
            'key' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:1000'],
            'style' => ['required', 'string', Rule::in(['style-1', 'style-2', 'style-3', 'style-4', 'style-5'])],
            'status' => Rule::in(BaseStatusEnum::values()),
        ];
    }
}