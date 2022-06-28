<?php


namespace App\Services\File;

use App\Models\FileUpload;
use App\Services\File\Interfaces\MediaConfigInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Config;
use App\Services\File\Enum\Disk;
use Intervention\Image\Facades\Image;

class CreateFileUploadService
{
    /**
     *
     * @param UploadedFile $file
     * @param  $disk
     * @param MediaConfigInterface $config
     */

    public function add(UploadedFile $file, Disk $disk, MediaConfigInterface $config, $configPath = 'fileupload.product_path')

    {
        $file_path = Config::get($configPath);
        $path = $file->store($file_path);
        $sizes = $config->getSizes();
        $thumbs = [];


        foreach ($sizes as $size){
            [ 'filename' => $filename,'basename' => $basename, 'dirname' => $dirname ,'extension' => $extension]  = pathinfo($path);
            $image = Image::make($file);
            $filename = $size ."-" . $filename;
            $image_path = storage_path('app/' . $file_path);

            $image->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
            });


            $image->save($image_path . '/thumbs/' . $filename . "." . $extension);
            $thumbs[$size] = [
                'filename' => $filename . '.' . $extension,
            ];
        }

        return FileUpload::create([
            'client_name' => $file->getClientOriginalName(),
            'original_name' => basename($path),
            'disk' => $disk->getValue(),
            'mime_type' => $file->getMimeType(),
            'thumbs' => $thumbs,
            'entity_type' => $config->getEntityType(),
            'entity_id' => $config->getEntityId(),
            'params' => $config->setParams(),
        ]);
    }
}
