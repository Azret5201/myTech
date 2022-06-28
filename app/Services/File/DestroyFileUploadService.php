<?php


namespace App\Services\File;

use App\Models\FileUpload;
use App\Services\File\Exception\FileNotFound;
use Illuminate\Support\Facades\Storage;
use App\Services\File\EnumException\ExceptionMessages;

class DestroyFileUploadService
{
    public function destroy($id)
    {
        if(!$file = FileUpload::where('id', $id)->first()){
            throw new FileNotFound(ExceptionMessages::FILE_NOT_FOUND());
        }

        $thumbs = $file->thumbs;
        Storage::delete($file->original_name);

        foreach ($thumbs as $thumb) {
            Storage::delete($thumb->filename);
        }
        $file->delete();
    }
}
