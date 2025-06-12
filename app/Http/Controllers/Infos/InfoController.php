<?php

namespace App\Http\Controllers\Infos;

use App\Domain\Infos\Actions\StoreInfoAction;
use App\Domain\Infos\Actions\UpdateInfoAction;
use App\Domain\Infos\DTO\StoreInfoDTO;
use App\Domain\Infos\DTO\UpdateInfoDTO;
use App\Domain\Infos\Models\Info;
use App\Domain\Infos\Repositories\InfoRepository;
use App\Domain\Infos\Requests\StoreInfoRequest;
use App\Domain\Infos\Requests\UpdateInfoRequest;
use App\Domain\Infos\Resources\InfoResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public mixed $infos;

    public function __construct(InfoRepository $infoRepository)
    {
        $this->infos = $infoRepository;
    }

    public function index()
    {
        $is_active = request()->query('is_active');
        $grouped = $this->infos->findCategoryId($is_active);
        return $grouped->map(function ($infos, $categoryName) {
            return [
                'category' => $categoryName,
                'infos' => InfoResource::collection($infos),
            ];
        })->values();
    }

    public function store(StoreInfoRequest $request, StoreInfoAction $action)
    {
        try {
            $dto = StoreInfoDTO::fromArray($request->validated());
            $response = $action->execute($dto);

            return $this->successResponse('', new InfoResource($response));
        } catch (Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    public function update(UpdateInfoRequest $request, Info $info,UpdateInfoAction $action)
    {
        try {
            $dto = UpdateInfoDTO::fromArray(array_merge($request->validated(),[
                'info' => $info
            ]));
            $response = $action->execute($dto);

            return $this->successResponse('updated', new InfoResource($response));
        } catch (Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }
}
