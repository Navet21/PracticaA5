<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Http\FormRequest;

class CommunityLinkForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'link' => 'required|url|max:255',
            'channel_id' => 'required|exists:channels,id',
        ];
    }

    public function messages(): array
    {
        return[
            'channel_id.required' => 'Tienes que seleccionar un canal'
        ];
    }
}

// ¿De quién hereda la clase CommunityLinkForm?
// La hereda de Request