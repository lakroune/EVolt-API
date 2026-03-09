<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateChargingStationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return  Gate::allows('admin-only');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'power_kw' => 'required|numeric|min:0',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address' => 'required|string|max:255',
            'status' => 'required|in:available,occupied,maintenance,offline',
            'price_per_kwh' => 'nullable|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom de la station est requis.',
            'power_kw.required' => 'La puissance de la station est requise.',
            'latitude.required' => 'La latitude de la station est requise.',
            'longitude.required' => 'La longitude de la station est requise.',
            'address.required' => 'L\'adresse de la station est requise.',
            'status.required' => 'Le statut de la station est requis.',
            'price_per_kwh.numeric' => 'Le prix par kWh doit être un nombre.',
        ];
    }
}
