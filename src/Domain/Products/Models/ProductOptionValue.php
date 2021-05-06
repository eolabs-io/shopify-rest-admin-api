<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\ProductOptionValueFactory;

class ProductOptionValue extends ShopifyModel
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_option_id',
        'value',
    ];

    public function productOption()
    {
        return $this->belongsTo(ProductOption::class);
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return ProductOptionValueFactory::new();
    }
}
