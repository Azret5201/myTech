<?php

namespace App\Http\Requests\ControlPanel\Admin;

use App\Enum\Icons;
use App\Models\FileUpload;
use App\Services\File\CreateFileUploadService;
use App\Services\File\DestroyFileUploadService;
use App\Services\File\Enum\Disk;
use App\Services\File\Interfaces\EditorMediaClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EditorImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::guard('web')->check() && 1 === Auth::guard('web')->user()->type_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    protected function prepareForValidation()
    {

    }

    public function getAll()
    {
        return FileUpload::getAllWhereEntityType(EditorMediaClass::class);
    }

    public function saveImage()
    {
        $file = $this->lib_images;
        $productMedia = new EditorMediaClass(0, $file->getClientOriginalName(), ['800'], 'editor_library');
        $disk = Disk::LOCAL();
        $createFileUpload = new CreateFileUploadService();
        return $createFileUpload->add($file, $disk, $productMedia, 'fileupload.editor_library_path');
    }

    public function getIconsForImages(): array
    {
        return [
            'check' => Icons::CHECK(),
            'delete' => Icons::CLOSE(),
            'edit' => Icons::EDIT()
        ];
    }

    public function deleteImage()
    {
        $destroy = new DestroyFileUploadService;
        $destroy->destroy($this->image_id);
        return $this->data_id;
    }
}
