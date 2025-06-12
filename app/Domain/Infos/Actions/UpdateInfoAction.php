<?php

namespace App\Domain\Infos\Actions;

use App\Domain\Infos\DTO\StoreInfoDTO;
use App\Domain\Infos\DTO\UpdateInfoDTO;
use App\Domain\Infos\Models\Info;
use Exception;
use Illuminate\Support\Facades\DB;

class UpdateInfoAction
{
    /**
     * @param UpdateInfoDTO $dto
     * @return Info
     * @throws Exception
     */
    public function execute(UpdateInfoDTO $dto): Info
    {
        DB::beginTransaction();
        try {
            $info = $dto->getInfo();
            $info->category_id = $dto->getCategoryDd();
            $info->name = $dto->getName();
            $info->url = $dto->getUrl();
            $info->is_active = $dto->isIsActive();
            $info->update();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
        return $info;
    }
}
