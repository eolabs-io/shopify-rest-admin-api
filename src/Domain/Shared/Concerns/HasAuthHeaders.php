<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns;

trait HasAuthHeaders
{

    /**
     * Get the Header fields for the token request.
     *
     * @return array
     */
    protected function getAuthHeaders(): array
    {
        return [
                'X-Shopify-Access-Token' => $this->getAdminApiPassword(),
            ];
    }

    /**
     * Get the Client Id.
     *
     * @return string
     */
    private function getAdminApiPassword(): string
    {
        return config('shopify.admin_api_password');
    }
}
