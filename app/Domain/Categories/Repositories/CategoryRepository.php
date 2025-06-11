<?php

namespace App\Domain\Categories\Repositories;

use App\Domain\Categories\Models\Category;
use App\Domain\FacultyDebts\Models\FacultyDebt;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{
    /**
     * @param $pagination
     * @return LengthAwarePaginator
     */
    public function paginate($pagination): LengthAwarePaginator
    {
        return Category::query()
            ->paginate($pagination);
    }

    /**
     * @return array|Collection
     */
    public function getAll(): array|Collection
    {
        return Category::query()
            ->get()
            ->sortBy('name');
    }
}
