<?php

namespace App\Http\Controllers\Categories;

use App\Domain\Categories\Actions\StoreCategoryAction;
use App\Domain\Categories\Actions\UpdateCategoryAction;
use App\Domain\Categories\DTO\StoreCategoryDTO;
use App\Domain\Categories\DTO\UpdateCategoryDTO;
use App\Domain\Categories\Models\Category;
use App\Domain\Categories\Repositories\CategoryRepository;
use App\Domain\Categories\Requests\StoreCategoryRequest;
use App\Domain\Categories\Requests\UpdateCategoryRequest;
use App\Domain\Categories\Resources\CategoryResource;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var mixed|CategoryRepository
     */
    public mixed $categories;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categories = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryResource::collection($this->categories->paginate(\request()->query('pagination',20)));
    }

    public function getAll()
    {
        return CategoryResource::collection($this->categories->getAll());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request, StoreCategoryAction $action)
    {
        try {
            $dto = StoreCategoryDTO::fromArray($request->validated());
            $response = $action->execute($dto);

            return $this->successResponse('',new CategoryResource($response));
        }catch (Exception $exception){
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request,Category $category, UpdateCategoryAction $action)
    {
        try {
            $dto = UpdateCategoryDTO::fromArray(array_merge($request->validated(),['category' => $category]));
            $response = $action->execute($dto);

            return $this->successResponse('updated',new CategoryResource($response));
        }catch (Exception $exception){
            return $this->errorResponse($exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return $this->successResponse('Category deleted successfully');
    }
}
