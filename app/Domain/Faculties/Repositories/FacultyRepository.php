<?php

namespace App\Domain\Faculties\Repositories;

use App\Domain\Faculties\Models\Faculty;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class FacultyRepository
{
    /**
     * @return Builder[]|Collection
     */
    public function getAll(): Collection|array
    {
        return Faculty::query()
            ->get()
            ->sortBy('name');
    }
}
