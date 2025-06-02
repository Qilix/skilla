<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type_id' => 'required|exists:order_types,id',
            'partnership_id' => 'required|exists:partnerships,id',
            'description' => 'required|string',
            'date' => 'required|date|after_or_equal:today',
            'address' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'status' => 'sometimes|in:created,assigned,completed'
        ];
    }
}
