<?php

namespace App\Domain\FacultyDebts\Resources;

use App\Domain\Faculties\Resources\FacultyResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FacultyDebtResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'number_of_students' => $this->number_of_students,
            'number_of_students_paid' => $this->number_of_students_paid,
            'number_of_students_not_paid' => $this->number_of_students_not_paid,
            'amount_of_debt' => number_format($this->amount_of_debt,3),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'faculty' => new FacultyResource($this->faculty)
        ];
    }
}
