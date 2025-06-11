<?php

namespace App\Domain\Categories\DTO;

class StoreCategoryDTO
{
    /**
     * @var string
     */
    private string $name;

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): self
    {
        $dto = new self();
        $dto->setName($data['name']);

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
}
