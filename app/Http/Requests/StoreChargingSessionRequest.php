<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChargingSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'reservation_id' => 'required|exists:reservations,id',
            
        ];
    }

    public function messages()
    {
        return [
            'reservation_id.required' => 'Le champ reservation_id est requis.',
            'reservation_id.exists' => 'La réservation spécifiée n\'existe pas.',
            
        ];
    }
}
