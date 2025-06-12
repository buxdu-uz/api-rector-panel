<?php

namespace App\Domain\Categories\Actions;

use App\Domain\Categories\DTO\StoreCategoryDTO;
use App\Domain\Categories\DTO\UpdateCategoryDTO;
use App\Domain\Categories\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateCategoryAction
{
    /**
     * @param UpdateCategoryDTO $dto
     * @return Category
     * @throws Exception
     */
    public function execute(UpdateCategoryDTO $dto): Category
    {
        DB::beginTransaction();
        try {
            $category = $dto->getCategory();
            $category->name = $dto->getName();
            $category->is_active = $dto->isIsActive();
            $category->update();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $category;
    }
}
