<?php

namespace App\Domain\Categories\Actions;

use App\Domain\Categories\DTO\StoreCategoryDTO;
use App\Domain\Categories\Models\Category;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreCategoryAction
{
    /**
     * @param StoreCategoryDTO $dto
     * @return Category
     * @throws Exception
     */
    public function execute(StoreCategoryDTO $dto): Category
    {
        DB::beginTransaction();
        try {
            $category = new Category();
            $category->name = $dto->getName();
            $category->save();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $category;
    }
}
