<?php

namespace App\Http\Controllers\Faculties;

use App\Domain\FacultyDebts\Actions\StoreFacultyDebtAction;
use App\Domain\FacultyDebts\Actions\UpdateFacultyDebtAction;
use App\Domain\FacultyDebts\DTO\StoreFacultyDebtDTO;
use App\Domain\FacultyDebts\DTO\UpdateFacultyDebtDTO;
use App\Domain\FacultyDebts\Models\FacultyDebt;
use App\Domain\FacultyDebts\Repositories\FacultyDebtRepository;
use App\Domain\FacultyDebts\Requests\StoreFacultyDebtRequest;
use App\Domain\FacultyDebts\Resources\FacultyDebtResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FacultyDebtController extends Controller
{
    /**
     * @var mixed|FacultyDebtRepository
     */
    public mixed $facultyDebts;

    /**
     * @param FacultyDebtRepository $facultyDebtRepository
     */
    public function __construct(FacultyDebtRepository $facultyDebtRepository)
    {
        $this->facultyDebts = $facultyDebtRepository;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function paginate()
    {
        return FacultyDebtResource::collection($this->facultyDebts->paginate(\request()->query('pagination', 20)));
    }

    /**
     * @param StoreFacultyDebtRequest $request
     * @param StoreFacultyDebtAction $action
     * @return JsonResponse
     */
    public function store(StoreFacultyDebtRequest $request, StoreFacultyDebtAction $action)
    {
        try {
            $dto = StoreFacultyDebtDTO::fromArray($request->validated());
            $response = $action->execute($dto);

            return $this->successResponse('Faculty debt created successfully',
                new FacultyDebtResource($response));
        } catch (Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * @param StoreFacultyDebtRequest $request
     * @param FacultyDebt $faculty_debt
     * @param UpdateFacultyDebtAction $action
     * @return JsonResponse
     */
    public function update(StoreFacultyDebtRequest $request, FacultyDebt $faculty_debt, UpdateFacultyDebtAction $action)
    {
        try {
            $dto = UpdateFacultyDebtDTO::fromArray(array_merge($request->validated(), ['faculty_debt' => $faculty_debt]));
            $response = $action->execute($dto);

            return $this->successResponse('Faculty debt updated successfully',
                new FacultyDebtResource($response));
        } catch (Exception $exception) {
            return $this->errorResponse($exception->getMessage());
        }
    }
}
