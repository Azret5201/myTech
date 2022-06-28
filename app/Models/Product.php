<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Kyslik\ColumnSortable\Sortable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Product extends Model
{
    use HasFactory;
    use Sortable;
    use HasSlug;

    protected $fillable = [
        'name',
        'vendor_code',
        'description',
        'brand_id',
        'category_id',
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public static function store(array $data): void
    {
        self::create($data);
    }

    public static function updateById(int $id, array $data): void
    {
        self::find($id)->update($data);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function productProperties(): HasMany
    {
        return $this->hasMany(ProductProperty::class, 'product_id');
    }
    public function users()
    {
        return $this->hasMany(UserProducts::class);
    }

    public function getProduct($productName)
    {
        return Product::select(["name", 'id'])
            ->where('name', 'LIKE', '%'.$productName.'%')
            ->get();
    }

    public function getCurrentUser()
    {
        return Auth::user();
    }

    public function storeUserProduct($id, $quantity)
    {
        $user_product = UserProducts::create([
            'product_id' => $id,
            'user_id' => self::getCurrentUser()->id,
            'quantity' => $quantity,
        ]);
        $user_product->save();
        return $user_product;
    }

    public function storeUserProductProp($propIds, $propsVal, string $id):void
    {

        $default_properties = DefaultProperty::find($propIds);
        foreach ($default_properties as $default_property) {
            $userProductProp = UserProductProperties::create([
                'default_property_id' => $default_property->id,
                'user_product_id' => $id,
                'value' => $propsVal['prop_'.$default_property->id]
            ]);
            $userProductProp->save();
        }
    }

    public function updateUserProductProps($propsIds, $propsVal, $id): void
    {
        UserProductProperties::where('user_product_id', $id)->delete();

        self::storeUserProductProp($propsIds, $propsVal, $id);

    }

    public function updateQuantityProd($quantity, $id): void
    {
        $userProduct = UserProducts::find($id);
        $userProduct->update([
            'quantity' => $quantity
        ]);
        $userProduct->save();
    }

    public function images(): hasMany
    {
        return $this->hasMany(FileUpload::class, 'entity_id');
    }

    public function blocks(): belongsToMany
    {
        return $this->belongsToMany(Block::class, 'products_blocks');
    }

    public function getMinPrice()
    {
        $pricePropId = DefaultProperty::where('is_price', true)->first()->id;
        $userProdIds = [];
        foreach ($this->users as $userProd) {
            $userProdIds[] = $userProd->id;
        }
        $userProdProps = UserProductProperties::whereIn('user_product_id', $userProdIds)
            ->where('default_property_id', $pricePropId)->get();
        $minPrice = round(($userProdProps->min('value'))/12);
        return $minPrice;
    }


}
