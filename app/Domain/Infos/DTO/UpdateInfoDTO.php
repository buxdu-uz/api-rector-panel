<?php

namespace App\Domain\Infos\DTO;

use App\Domain\Infos\Models\Info;

class UpdateInfoDTO
{
    private int $category_dd;
    private string $name;
    private string $url;
    private bool $is_active;
    private Info $info;

    public static function fromArray(array $data): self
    {
        $dto = new self();
        $dto->setCategoryDd($data['category_id']);
        $dto->setName($data['name']);
        $dto->setUrl($data['url']);
        $dto->setIsActive($data['is_active']);
        $dto->setInfo($data['info']);

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
     * @return Info
     */
    public function getInfo(): Info
    {
        return $this->info;
    }

    /**
     * @param Info $info
     */
    public function setInfo(Info $info): void
    {
        $this->info = $info;
    }
}
