<?php

namespace App\Domain\FacultyDebts\Repositories;

use App\Domain\FacultyDebts\Models\FacultyDebt;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FacultyDebtRepository
{
    /**
     * @param $pagination
     * @return LengthAwarePaginator
     */
    public function paginate($pagination): LengthAwarePaginator
    {
        return FacultyDebt::query()
            ->paginate($pagination);
    }
}
