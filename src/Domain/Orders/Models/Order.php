<?php
namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models;

use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Money;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\Refund;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\LineItem;
use EolabsIo\ShopifyRestAdminApi\Database\Factories\OrderFactory;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Address;
use EolabsIo\ShopifyRestAdminApi\Domain\Customers\Models\Customer;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\DiscountCode;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\ShippingLine;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Models\ShopifyModel;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\ClientDetails;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\NoteAttribute;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\PaymentDetails;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\PaymentGatewayName;
use EolabsIo\ShopifyRestAdminApi\Domain\Orders\Models\DiscountApplication;
use EolabsIo\ShopifyRestAdminApi\Domain\ShippingFulfillment\Models\Fulfillment;

class Order extends ShopifyModel
{
    const CREATED_AT = 'model_created_at';
    const UPDATED_AT = 'model_updated_at';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'closed_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'cancelled_at' => 'datetime',
        'processed_at' => 'datetime',
        'test' => 'boolean',
        'taxes_included' => 'boolean',
        'confirmed' => 'boolean',
        'buyer_accepts_marketing' => 'boolean',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'email',
        'closed_at',
        'created_at',
        'updated_at',
        'number',
        'note',
        'token',
        'gateway',
        'test',
        'total_price',
        'subtotal_price',
        'total_weight',
        'total_tax',
        'taxes_included',
        'currency',
        'financial_status',
        'confirmed',
        'total_discounts',
        'total_line_items_price',
        'cart_token',
        'buyer_accepts_marketing',
        'name',
        'referring_site',
        'landing_site',
        'cancelled_at',
        'cancel_reason',
        'total_price_usd',
        'checkout_token',
        'reference',
        'user_id',
        'location_id',
        'source_identifier',
        'source_url',
        'processed_at',
        'device_id',
        'phone',
        'customer_locale',
        'app_id',
        'browser_ip',
        'client_details_id',
        'landing_site_ref',
        'order_number',
        'payment_details_id',
        'processing_method',
        'checkout_id',
        'source_name',
        'fulfillment_status',
        'tags',
        'contact_email',
        'order_status_url',
        'presentment_currency',
        'total_line_items_price_set_id',
        'total_discounts_set_id',
        'total_shipping_price_set_id',
        'subtotal_price_set_id',
        'total_price_set_id',
        'total_tax_set_id',
        'total_tip_received',
        'admin_graphql_api_id',
        'billing_address_id',
        'shipping_address_id',
        'customer_id',
    ];


    public function clientDetails()
    {
        return $this->belongsTo(ClientDetails::class, 'client_details_id')->withDefault();
    }

    public function paymentDetails()
    {
        return $this->belongsTo(PaymentDetails::class)->withDefault();
    }

    public function totalLineItemsPriceSet()
    {
        return $this->belongsTo(Money::class, 'total_line_items_price_set_id')->withDefault();
    }

    public function totalDiscountsSet()
    {
        return $this->belongsTo(Money::class, 'total_discounts_set_id')->withDefault();
    }

    public function totalShippingPriceSet()
    {
        return $this->belongsTo(Money::class, 'total_shipping_price_set_id')->withDefault();
    }

    public function subtotalPriceSet()
    {
        return $this->belongsTo(Money::class, 'subtotal_price_set_id')->withDefault();
    }

    public function totalPriceSet()
    {
        return $this->belongsTo(Money::class, 'total_price_set_id')->withDefault();
    }

    public function totalTaxSet()
    {
        return $this->belongsTo(Money::class, 'total_tax_set_id')->withDefault();
    }

    public function billingAddress()
    {
        return $this->belongsTo(Address::class, 'billing_address_id')->withDefault();
    }

    public function shippingAddress()
    {
        return $this->belongsTo(Address::class, 'shipping_address_id')->withDefault();
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class)->withDefault();
    }

    public function discountApplications()
    {
        return $this->hasMany(DiscountApplication::class);
    }

    public function discountCodes()
    {
        return $this->hasMany(DiscountCode::class);
    }

    public function noteAttributes()
    {
        return $this->hasMany(NoteAttribute::class);
    }

    public function paymentGatewayNames()
    {
        return $this->hasMany(PaymentGatewayName::class);
    }

    public function taxLines()
    {
        return $this->belongsToMany(TaxLine::class);
    }

    public function lineItems()
    {
        return $this->hasMany(LineItem::class);
    }

    public function fulfillments()
    {
        return $this->hasMany(Fulfillment::class);
    }

    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }

    public function shippingLines()
    {
        return $this->hasMany(ShippingLine::class);
    }

    /**
    * Create a new factory instance for the model.
    *
    * @return \Illuminate\Database\Eloquent\Factories\Factory
    */
    public static function newFactory()
    {
        return OrderFactory::new();
    }
}
