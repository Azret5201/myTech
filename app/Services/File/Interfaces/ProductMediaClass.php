<?php

namespace App\Services\File\Interfaces;

class ProductMediaClass implements MediaConfigInterface
{
    private int $entityId;
    private string $entityType;
    private string $clientName;
    private string $OriginalName;
    private array $sizes;
    private $params;

    public function __construct($entityId, $clientName, $sizes, $params)
    {
        $this->entityId = $entityId ?? 1;
        $this->entityType = get_class($this);
        $this->clientName = $clientName;
        $this->sizes = $sizes;
        $this->params = $params;
    }
    public function getEntityId(): int
    {
        return $this->entityId;
    }

    public function getEntityType(): string
    {
        return $this->entityType;
    }
    public function getClientName(): string
    {
        return $this->clientName;
    }
    public function getOriginalName(): string
    {
        return '';
    }
    public function getSizes(): array
    {
        return $this->sizes;
    }

    public function setParams(): array
    {
        return ['order' => $this->params];
    }
}
