<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTodoRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'due_at' => 'required|date_format:Y-m-d H:i'
        ];
    }

}
