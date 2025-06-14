<?php

namespace App\Domain\Infos\Resources;

use App\Domain\Categories\Resources\CategoryResource;
use App\Domain\Faculties\Resources\FacultyResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'url' => $this->url,
            'is_active' => $this->is_active,
//            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
