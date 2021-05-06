<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Customers\Concerns;

use Illuminate\Support\Carbon;

trait CustomerQueryable
{
    /** @var array */
    private $customerQueryableParameters = [
        'ids' => null,
        'since_id' => null,
        'created_at_min' => null,
        'created_at_max' => null,
        'updated_at_min' => null,
        'updated_at_max' => null,
        'limit' => null,
        'fields' => null,
    ];

    /** @var string */
    private $customerId;


    public function withCustomerId($id = null): self
    {
        $this->customerId = $id;

        return $this;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    public function hasCustomerId(): bool
    {
        return filled($this->customerId);
    }

    public function withCustomerIds($ids = null): self
    {
        $this->customerQueryableParameters['ids'] = (is_array($ids))
            ? implode(',', $ids)
            : null;

        return $this;
    }

    public function withSinceId($id = null): self
    {
        $this->customerQueryableParameters['since_id'] = $id;

        return $this;
    }

    public function withCreatedAtMin(Carbon $date = null): self
    {
        $this->customerQueryableParameters['created_at_min'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withCreatedAtMax(Carbon $date = null): self
    {
        $this->customerQueryableParameters['created_at_max'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withUpdatedAtMin(Carbon $date = null): self
    {
        $this->customerQueryableParameters['updated_at_min'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withUpdatedAtMax(Carbon $date = null): self
    {
        $this->customerQueryableParameters['updated_at_max'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withLimit($limit = null): self
    {
        if ($limit > 250) {
            $limit = 250;
        }

        $this->customerQueryableParameters['limit'] = $limit;

        return $this;
    }

    public function withFields($fields = null): self
    {
        $this->customerQueryableParameters['fields'] = (is_array($fields))
            ? implode(',', $fields)
            : null;

        return $this;
    }

    public function getCustomerQueryableParameters(): array
    {
        return array_filter($this->customerQueryableParameters);
    }
}
