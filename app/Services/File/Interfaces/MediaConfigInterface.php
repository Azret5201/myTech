<?php


namespace App\Services\File\Interfaces;

use Illuminate\Http\UploadedFile;

interface MediaConfigInterface
{
    public function getEntityId(): int;
    public function getEntityType(): string;
    public function getClientName(): string;
    public function getOriginalName(): string;
    public function getSizes(): array;
    public function setParams(): array;

}
