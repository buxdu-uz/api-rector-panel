<?php

namespace App\Domain\FacultyDebts\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateFacultyDebtRequest extends FormRequest
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
            'faculty_id' => 'required|exists:faculties,id',
            'number_of_students' => 'required|integer|min:1',
            'number_of_students_paid' => 'required|integer|min:1',
            'number_of_students_not_paid' => 'required|integer|min:1',
            'amount_of_debt' => 'required|numeric',
            'faculty_debt' => 'sometimes|json',
        ];
    }
}
