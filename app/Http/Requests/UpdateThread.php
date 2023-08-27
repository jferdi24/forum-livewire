<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateThread extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', request()->thread);
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'title' => 'required',
            'body' => 'required',
        ];
    }
}
