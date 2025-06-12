<?php

namespace App\Domain\Categories\DTO;

use App\Domain\Categories\Models\Category;

class UpdateCategoryDTO
{
    /**
     * @var string
     */
    private string $name;
    private bool $is_active;
    private Category $category;

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): self
    {
        $dto = new self();
        $dto->setName($data['name']);
        $dto->setCategory($data['category']);
        $dto->setIsActive($data['is_active']);

        return $dto;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return bool
     */
    public function isIsActive(): bool
    {
        return $this->is_active;
    }

    /**
     * @param bool $is_active
     */
    public function setIsActive(bool $is_active): void
    {
        $this->is_active = $is_active;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }
}
