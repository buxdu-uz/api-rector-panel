<?php

namespace App\Domain\Infos\Repositories;

use App\Domain\Infos\Models\Info;

class InfoRepository
{
    public function findCategoryId($category_id,$is_active)
    {
        return Info::query()
            ->where('is_active', $is_active)
            ->where('category_id', $category_id)
            ->get();
    }
}
