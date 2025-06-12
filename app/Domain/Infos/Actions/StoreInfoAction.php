<?php

namespace App\Domain\Infos\Actions;

use App\Domain\Infos\DTO\StoreInfoDTO;
use App\Domain\Infos\Models\Info;
use Exception;
use Illuminate\Support\Facades\DB;

class StoreInfoAction
{
    /**
     * @param StoreInfoDTO $dto
     * @return Info
     * @throws Exception
     */
    public function execute(StoreInfoDTO $dto): Info
    {
        DB::beginTransaction();
        try {
            $info = new Info();
            $info->category_id = $dto->getCategoryDd();
            $info->name = $dto->getName();
            $info->url = $dto->getUrl();
            $info->save();
        }catch (Exception $exception){
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $info;
    }
}
