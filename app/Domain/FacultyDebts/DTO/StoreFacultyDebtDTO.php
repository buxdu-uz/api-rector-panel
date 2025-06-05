<?php

namespace App\Domain\FacultyDebts\DTO;

class StoreFacultyDebtDTO
{
    /**
     * @var int
     */
    private int $faculty_id;

    /**
     * @var int
     */
    private int $number_of_students;

    /**
     * @var int
     */
    private int $number_of_students_paid;

    /**
     * @var int
     */
    private int $number_of_students_not_paid;

    /**
     * @var int
     */
    private int $amount_of_debt;

    /**
     * @param array $data
     * @return StoreFacultyDebtDTO
     */
    public static function fromArray(array $data): StoreFacultyDebtDTO
    {
        $dto = new self();
        $dto->setFacultyId($data['faculty_id']);
        $dto->setNumberOfStudents($data['number_of_students']);
        $dto->setNumberOfStudentsPaid($data['number_of_students_paid']);
        $dto->setNumberOfStudentsNotPaid($data['number_of_students_not_paid']);
        $dto->setAmountOfDebt($data['amount_of_debt']);
        return $dto;
    }

    /**
     * @return int
     */
    public function getFacultyId(): int
    {
        return $this->faculty_id;
    }

    /**
     * @param int $faculty_id
     */
    public function setFacultyId(int $faculty_id): void
    {
        $this->faculty_id = $faculty_id;
    }

    /**
     * @return int
     */
    public function getNumberOfStudents(): int
    {
        return $this->number_of_students;
    }

    /**
     * @param int $number_of_students
     */
    public function setNumberOfStudents(int $number_of_students): void
    {
        $this->number_of_students = $number_of_students;
    }

    /**
     * @return int
     */
    public function getNumberOfStudentsPaid(): int
    {
        return $this->number_of_students_paid;
    }

    /**
     * @param int $number_of_students_paid
     */
    public function setNumberOfStudentsPaid(int $number_of_students_paid): void
    {
        $this->number_of_students_paid = $number_of_students_paid;
    }

    /**
     * @return int
     */
    public function getNumberOfStudentsNotPaid(): int
    {
        return $this->number_of_students_not_paid;
    }

    /**
     * @param int $number_of_students_not_paid
     */
    public function setNumberOfStudentsNotPaid(int $number_of_students_not_paid): void
    {
        $this->number_of_students_not_paid = $number_of_students_not_paid;
    }

    /**
     * @return int
     */
    public function getAmountOfDebt(): int
    {
        return $this->amount_of_debt;
    }

    /**
     * @param int $amount_of_debt
     */
    public function setAmountOfDebt(int $amount_of_debt): void
    {
        $this->amount_of_debt = $amount_of_debt;
    }
}
