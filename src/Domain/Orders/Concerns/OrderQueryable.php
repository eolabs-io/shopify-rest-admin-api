<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Orders\Concerns;

use Illuminate\Support\Carbon;

trait OrderQueryable
{
    /** @var array */
    private $orderQueryableParameters = [
        'ids' => null,
        'limit' => null,
        'since_id' => null,
        'created_at_min' => null,
        'created_at_max' => null,
        'updated_at_min' => null,
        'updated_at_max' => null,
        'processed_at_min' => null,
        'processed_at_max' => null,
        'attribution_app_id' => null,
        'status' => null,
        'financial_status' => null,
        'fulfillment_status' => null,
        'fields' => null,
    ];

    /** @var string */
    private $orderId;


    public function withOrderId($id = null): self
    {
        $this->orderId = $id;

        return $this;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function hasOrderId(): bool
    {
        return filled($this->orderId);
    }

    public function withOrderIds($ids = null): self
    {
        $this->orderQueryableParameters['ids'] = (is_array($ids))
            ? implode(',', $ids)
            : null;

        return $this;
    }

    public function withLimit($limit = null): self
    {
        if ($limit > 250) {
            $limit = 250;
        }

        $this->orderQueryableParameters['limit'] = $limit;

        return $this;
    }

    public function withSinceId($id = null): self
    {
        $this->orderQueryableParameters['since_id'] = $id;

        return $this;
    }

    public function withCreatedAtMin(Carbon $date = null): self
    {
        $this->orderQueryableParameters['created_at_min'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withCreatedAtMax(Carbon $date = null): self
    {
        $this->orderQueryableParameters['created_at_max'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withUpdatedAtMin(Carbon $date = null): self
    {
        $this->orderQueryableParameters['updated_at_min'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withUpdatedAtMax(Carbon $date = null): self
    {
        $this->orderQueryableParameters['updated_at_max'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withProcessedAtMin(Carbon $date = null): self
    {
        $this->orderQueryableParameters['processed_at_min'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withProcessedAtMax(Carbon $date = null): self
    {
        $this->orderQueryableParameters['processed_at_max'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withAttributionAppId($id = null): self
    {
        $this->orderQueryableParameters['attribution_app_id'] = $id;

        return $this;
    }

    public function withStatusAny(): self
    {
        $this->orderQueryableParameters['status'] = 'any';

        return $this;
    }

    public function withStatusOpen(): self
    {
        $this->orderQueryableParameters['status'] = 'open';

        return $this;
    }

    public function withStatusClosed(): self
    {
        $this->orderQueryableParameters['status'] = 'closed';

        return $this;
    }

    public function withStatusCancelled(): self
    {
        $this->orderQueryableParameters['status'] = 'cancelled';

        return $this;
    }

    public function withFinancialStatusAny(): self
    {
        $this->orderQueryableParameters['financial_status'] = null;

        return $this;
    }

    public function withFinancialStatusAuthorized(): self
    {
        $this->orderQueryableParameters['financial_status'] = 'authorized';

        return $this;
    }

    public function withFinancialStatusPending(): self
    {
        $this->orderQueryableParameters['financial_status'] = 'pending';

        return $this;
    }

    public function withFinancialStatusPaid(): self
    {
        $this->orderQueryableParameters['financial_status'] = 'paid';

        return $this;
    }

    public function withFinancialStatusPartiallyPaid(): self
    {
        $this->orderQueryableParameters['financial_status'] = 'partially_paid';

        return $this;
    }

    public function withFinancialStatusRefunded(): self
    {
        $this->orderQueryableParameters['financial_status'] = 'refunded';

        return $this;
    }

    public function withFinancialStatusVoided(): self
    {
        $this->orderQueryableParameters['financial_status'] = 'voided';

        return $this;
    }

    public function withFinancialStatusPartiallyRefunded(): self
    {
        $this->orderQueryableParameters['financial_status'] = 'partially_refunded';

        return $this;
    }

    public function withFinancialStatusUnpaid(): self
    {
        $this->orderQueryableParameters['financial_status'] = 'unpaid';

        return $this;
    }

    // fulfillment_status
    public function withFulfillmentStatusAny(): self
    {
        $this->orderQueryableParameters['fulfillment_status'] = null;

        return $this;
    }

    public function withFulfillmentStatusShipped(): self
    {
        $this->orderQueryableParameters['fulfillment_status'] = 'shipped';

        return $this;
    }

    public function withFulfillmentStatusPartial(): self
    {
        $this->orderQueryableParameters['fulfillment_status'] = 'partial';

        return $this;
    }

    public function withFulfillmentStatusUnshipped(): self
    {
        $this->orderQueryableParameters['fulfillment_status'] = 'unshipped';

        return $this;
    }

    public function withFulfillmentStatusUnfulfilled(): self
    {
        $this->orderQueryableParameters['fulfillment_status'] = 'unfulfilled';

        return $this;
    }

    public function withFields($fields = null): self
    {
        $this->orderQueryableParameters['fields'] = (is_array($fields))
            ? implode(',', $fields)
            : null;

        return $this;
    }

    public function getOrderQueryableParameters(): array
    {
        return array_filter($this->orderQueryableParameters);
    }
}
