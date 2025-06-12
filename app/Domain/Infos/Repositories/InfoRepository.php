<?php

namespace App\Domain\Infos\Repositories;

use App\Domain\Infos\Models\Info;

class InfoRepository
{
    public function findCategoryId($is_active)
    {
        return Info::query()
            ->when($is_active, function ($query) use ($is_active) {
                return $query->where('is_active', $is_active);
            })
            ->get()
            ->groupBy('category.name');
    }
}
