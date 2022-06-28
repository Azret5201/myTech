<?php

namespace App\Http\Requests\ControlPanel\Admin;

use App\Http\Requests\MessagesTrait;
use App\Models\DefaultProperty;
use App\Models\FileUpload;
use App\Models\Product;
use App\Models\ProductProperty;
use App\Rules\UploadCountForEdit;
use App\Services\File\CreateFileUploadService;
use App\Services\File\DestroyFileUploadService;
use App\Services\File\Enum\Disk;
use App\Services\File\Interfaces\ProductMediaClass;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    use MessagesTrait;

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
        if ('store' === $this->segment(4)) {
            return [
                'name' => 'required|unique:products,name',
                'vendor_code' => 'required|unique:products,vendor_code',
                'text' => 'required|max:5000',
                'pro_images.*' => 'mimes:jpg,jpeg,bmp,png,gif,svg|max:5000',
                'pro_images' => [new UploadCountForEdit($this->countImages, 10)]
            ];
        }
        if ('image' === $this->segment(4)) {
            return [
                'pro_images.*' => 'mimes:jpg,jpeg,bmp,png|max:5000',
                'pro_images' => [new UploadCountForEdit($this->countImages, 10)]
            ];
        }
        return [
            'name' => 'required|unique:products,name,' . $this->segment(5),
            'vendor_code' => 'required|unique:products,vendor_code,' . $this->segment(5),
            'text' => 'required|max:5000',
            'pro_images' => [new UploadCountForEdit($this->countImages, 10)],
        ];
    }

    public function prepareForValidation(): void
    {
        if (!is_array($this->image_id)) {
            $this->image_id = json_decode($this->image_id, true);
        }
        if ('image' == $this->segment(4)) {
            $this->pro_images = is_array($this->pro_images) ? $this->pro_images : [$this->pro_images];
            $this->image_id = is_array($this->image_id) ? $this->image_id : [$this->image_id];
            $this->countImages = $this->count + count($this->pro_images);
            $this->order = [$this->count + 1];
        } else {
            $this->countImages = count($this->image_id ?? []) + count($this->pro_images ?? []);
        }
        if (isset($this->prop)) {
            if (isset($this->shouldUser)) {
                foreach ($this->prop as $prop) {
                    if (in_array($prop['propName'], $this->shouldUser)) {
                        $prop['shouldUser'] = 1;
                    } else {
                        $prop['shouldUser'] = 0;
                    }
                    $props[] = $prop;
                }
                foreach ($this->shouldUser as $shouldUser) {
                    if (!in_array($shouldUser, array_column($props, 'propName'))) {
                        array_push($props, [
                            'propName' => $shouldUser,
                            'propVal' => null,
                            'shouldUser' => 1,
                        ]);
                    }
                }
            } else {
                foreach ($this->prop as $prop) {
                    $prop['shouldUser'] = 0;
                    $props[] = $prop;
                }
            }
            $this->prop = $props;
        }
    }

    public function persist(): void
    {
        $productId = Product::create([
            'name' => $this->name,
            'vendor_code' => $this->vendor_code,
            'description' => $this->text,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
        ])->id;
        if (isset($this->prop)) {
            $this->updateOrCreateProp($productId);
        }
        if (!empty($this->pro_images)) {
            $this->createImage($productId, $this->order);
        }
        if (!empty($this->image_id)) {
            foreach ($this->image_id as $item) {
                FileUpload::checkOrUpdateOrder($item['id'], $item['order']);
            }
        }
        self::addPriceRelation($productId);
    }

    public function addPriceRelation($productId)
    {
        $pricePropId = DefaultProperty::where('is_price', true)->first()->id;
        ProductProperty::create([
            'default_property_id' => $pricePropId,
            'product_id' => $productId,
            'should_user_fill' => true,

        ]);
    }
    public function updateOrCreateProp($productId)
    {
        foreach ($this->prop as $prop) {
            if ($prop['propName'] == null) {
                ProductProperty::where('id', $prop['productProp_id'])->delete();
                continue;
            }
            $propertyNameId = DefaultProperty::checkGetId($prop['propName']) ? DefaultProperty::checkGetID($prop['propName']) : DefaultProperty::storeGetId($prop['propName']);
            ProductProperty::updateOrCreateById(
                $propertyNameId,
                $productId,
                $prop['propVal'],
                $prop['shouldUser'],
                $prop['productProp_id'] ?? 0,
            );
        }
    }

    public function update(int $id): void
    {
        Product::updateById($id, [
            'name' => $this->name,
            'vendor_code' => $this->vendor_code,
            'description' => $this->text,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
        ]);
        if (isset($this->prop)) {
            $this->updateOrCreateProp($id);
        }
        if (!empty($this->image_id)) {
            foreach ($this->image_id as $item) {
                FileUpload::checkOrUpdateOrder($item['id'], $item['order']);
            }
        }
        if (!empty($this->pro_images)) {
            $this->createImage($id, [$this->count]);
        }
    }

    public function createImage($productId, $order)
    {
        foreach ($this->pro_images as $key => $file) {
            $productMedia = new ProductMediaClass($productId, $file->getClientOriginalName(), ['100', '180', '450', '800'], $order[$key]);
            if (is_int($file)) {
                continue;
            } else {
                $disk = Disk::LOCAL();
                $createFileUpload = new CreateFileUploadService();
                $createFileUpload->add($file, $disk, $productMedia);
            }
        }
    }

    public function storeImage()
    {
        $this->createImage($this->product_id, [$this->count]);
        return FileUpload::where('entity_id', $this->product_id)->where('params->order', $this->count)->first();
    }

    public function sortImage()
    {
        if (!empty($this->image_id)) {
            $i = 0;
            foreach ($this->image_id as $item) {
                FileUpload::checkOrUpdateOrder($item['id'], $i);
                $i++;
            }
        }
    }

    public function destroyImage(): string
    {
        $id = array_search($this->deleted_id, array_column($this->image_id, 'id'));
        if ($id >= 0) {
            unset($this->image_id[$id]);
        }
        if (!empty($this->image_id)) {
            $i = 0;
            foreach ($this->image_id as $item) {
               FileUpload::checkOrUpdateOrder($item['id'], $i);
                $i++;
            }
        }
        $destroy = new DestroyFileUploadService;
        $destroy->destroy($this->deleted_id);

        return $this->num;
    }
}
