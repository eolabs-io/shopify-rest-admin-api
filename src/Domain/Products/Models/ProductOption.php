<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\ProductOptionFactory;

class ProductOption extends ShopifyModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'product_id',
        'name',
        'position',
    ];

    public function values()
    {
        return $this->hasMany(ProductOptionValue::class);
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return ProductOptionFactory::new();
    }
}
