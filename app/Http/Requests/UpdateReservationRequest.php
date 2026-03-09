<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
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
            'start_time' => 'required|date|after_or_equal:now',
            'estimated_duration_minutes' => 'required|integer|min:10',
        ];
    }

    public function messages()
    {
        return [
            'start_time.required' => 'Le champ heure de début est requis.',
            'start_time.date' => 'Le champ heure de début doit être une date valide.',
            'start_time.after_or_equal' => 'L\'heure de début doit être égale ou postérieure à maintenant.',
            'estimated_duration_minutes.required' => 'Le champ durée estimée en minutes est requis.',
            'estimated_duration_minutes.integer' => 'Le champ durée estimée en minutes doit être un entier.',
            'estimated_duration_minutes.min' => 'Le champ durée estimée en minutes doit être au moins 10 minute.',
        ];
    }
}
