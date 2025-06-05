<?php

namespace App\Domain\FacultyDebts\Actions;

use App\Domain\FacultyDebts\DTO\StoreFacultyDebtDTO;
use App\Domain\FacultyDebts\DTO\UpdateFacultyDebtDTO;
use App\Domain\FacultyDebts\Models\FacultyDebt;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateFacultyDebtAction
{
    /**
     * @param UpdateFacultyDebtDTO $dto
     * @return FacultyDebt
     * @throws Exception
     */
    public function execute(UpdateFacultyDebtDTO $dto): FacultyDebt
    {
        DB::beginTransaction();
        try {
            $facultyDebt = $dto->getFacultyDebt();
            $facultyDebt->faculty_id = $dto->getFacultyId();
            $facultyDebt->number_of_students = $dto->getNumberOfStudents();
            $facultyDebt->number_of_students_paid = $dto->getNumberOfStudentsPaid();
            $facultyDebt->number_of_students_not_paid = $dto->getNumberOfStudentsNotPaid();
            $facultyDebt->amount_of_debt = $dto->getAmountOfDebt();
            $facultyDebt->update();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $facultyDebt;
    }
}
