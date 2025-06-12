<?php

namespace App\Domain\Infos\DTO;

class StoreInfoDTO
{
    private int $category_dd;
    private string $name;
    private string $url;

    public static function fromArray(array $data): self
    {
        $dto = new self();
        $dto->setCategoryDd($data['category_id']);
        $dto->setName($data['name']);
        $dto->setUrl($data['url']);

        return $dto;
    }

    /**
     * @return int
     */
    public function getCategoryDd(): int
    {
        return $this->category_dd;
    }

    /**
     * @param int $category_dd
     */
    public function setCategoryDd(int $category_dd): void
    {
        $this->category_dd = $category_dd;
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
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}
