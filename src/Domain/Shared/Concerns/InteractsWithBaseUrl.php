<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns;

trait InteractsWithBaseUrl
{

    /**
     * Get the Base URL.
     *
     * @return string
     */
    protected function getBaseUrl()
    {
        $shop = $this->getShop();
        $version = $this->getVersion();

        return "https://{$shop}.myshopify.com/admin/api/{$version}";
    }

    public function getShop(): string
    {
        return config('shopify.shop');
    }

    public function getVersion(): string
    {
        return config('shopify.api_version');
    }
}
