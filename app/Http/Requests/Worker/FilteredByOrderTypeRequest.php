<?php

namespace App\Http\Requests\Worker;

use Illuminate\Foundation\Http\FormRequest;

class FilteredByOrderTypeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'order_type_id' => 'required|array',
            'order_type_id.*' => 'required|integer|exists:order_types,id',
        ];
    }
}
