<?php

namespace App\Http\Controllers\Faculties;

use App\Domain\Faculties\Repositories\FacultyRepository;
use App\Domain\Faculties\Resources\FacultyResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * @var mixed|FacultyRepository
     */
    public mixed $faculties;

    /**
     * @param FacultyRepository $facultyRepository
     */
    public function __construct(FacultyRepository $facultyRepository)
    {
        $this->faculties = $facultyRepository;
    }

    /**
     * @return JsonResponse
     */
    public function getAll()
    {
        return $this->successResponse('', FacultyResource::collection($this->faculties->getAll()));
    }
}
