<?php

namespace App\Models;

use App\Casts\Json;
use App\Services\File\Interfaces\MediaConfigInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\File\Enum\Disk;

class FileUpload extends Model implements MediaConfigInterface
{
    protected $fillable = [
        'client_name',
        'original_name',
        'disk',
        'mime_type',
        'thumbs',
        'entity_type',
        'entity_id',
        'params',
    ];
    protected $casts = [
        'params' => Json::class,
        'thumbs' => Json::class,
    ];

    private $entityId = 1;
    private $entityType = "product";
    private $sizes = [ 1000 , 500 , 200 , 150];

    use HasFactory;

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
        return $this->originalName;
    }

    public function getSizes(): array
    {
        return $this->sizes;
    }

    public function setParams(): array
    {
        return [];
    }

    public function getPath(): string
    {
        return Disk::LOCAL_PATH().$this->original_name;
    }

    public static function checkOrUpdateOrder($id, $order)
    {
        $order = json_encode(['order' => $order]);
        self::where('id', $id)->update(['params' => $order]);
    }

    public static function getAllWhereEntityType($class)
    {
        return self::where('entity_type', $class)->orderBy('created_at', 'desc')->select('id', 'original_name')->get();
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'entity_id');
    }
}
