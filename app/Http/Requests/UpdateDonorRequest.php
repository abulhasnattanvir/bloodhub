<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDonorRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'profile_photo' => ['nullable', 'image', 'max:2048'], // 2MB max
            'blood_group_id' => ['required', 'exists:blood_groups,id'],
            'phone_number' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'in:male,female,other'],
            'address' => ['required', 'string'],
            'last_donation_date' => ['nullable', 'date'],
            'availability_status' => ['required', 'in:available,not_available'],
            'email' => ['nullable', 'email', 'max:255', 'unique:donors,email,'.$this->donor->id],
            'notes' => ['nullable', 'string'],
        ];
    }
}
