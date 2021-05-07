<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\ProductImageFactory;

class ProductImage extends ShopifyModel
{
    const CREATED_AT = 'model_created_at';
    const UPDATED_AT = 'model_updated_at';

    public $incrementing = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'published_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'product_id',
        'position',
        'created_at',
        'updated_at',
        'alt',
        'width',
        'height',
        'src',
        // 'variant_ids',
        'admin_graphql_api_id'
    ];


    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return ProductImageFactory::new();
    }
}
