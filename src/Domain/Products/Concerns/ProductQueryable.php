<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Products\Concerns;

use Illuminate\Support\Carbon;

trait ProductQueryable
{
    /** @var array */
    private $productQueryableParameters = [
        'ids' => null,
        'limit' => null,
        'since_id' => null,
        'title' => null,
        'vendor' => null,
        'handle' => null,
        'product_type' => null,
        'status' => null,
        'collection_id' => null,
        'created_at_min' => null,
        'created_at_max' => null,
        'updated_at_min' => null,
        'updated_at_max' => null,
        'published_at_min' => null,
        'published_at_max' => null,
        'published_status' => null,
        'fields' => null,
        'presentment_currencies' => null,
    ];

    /** @var string */
    private $productId;


    public function withProductId($id = null): self
    {
        $this->productId = $id;

        return $this;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function hasProductId(): bool
    {
        return filled($this->productId);
    }

    public function withProductIds($ids = null): self
    {
        $this->productQueryableParameters['ids'] = (is_array($ids))
            ? implode(',', $ids)
            : null;

        return $this;
    }

    public function withLimit($limit = null): self
    {
        if ($limit > 250) {
            $limit = 250;
        }

        $this->productQueryableParameters['limit'] = $limit;

        return $this;
    }

    public function withSinceId($id = null): self
    {
        $this->productQueryableParameters['since_id'] = $id;

        return $this;
    }


    public function withTitle($title = null): self
    {
        $this->productQueryableParameters['title'] = $title;

        return $this;
    }

    public function withVendor($vendor  = null): self
    {
        $this->productQueryableParameters['vendor '] = $vendor ;

        return $this;
    }

    public function withHandle($handle = null): self
    {
        $this->productQueryableParameters['handle'] = (is_array($handle))
            ? implode(',', $handle)
            : null;

        return $this;
    }

    public function withProductType($productType = null): self
    {
        $this->productQueryableParameters['product_type'] = $productType;

        return $this;
    }

    public function withStatusAny(): self
    {
        $this->productQueryableParameters['status'] = null;

        return $this;
    }

    public function withStatusActive(): self
    {
        $this->productQueryableParameters['status'] = 'active';

        return $this;
    }

    public function withStatusArchived(): self
    {
        $this->productQueryableParameters['status'] = 'archived';

        return $this;
    }

    public function withStatusDraft(): self
    {
        $this->productQueryableParameters['status'] = 'draft';

        return $this;
    }

    public function withCollectionId($collectionId = null): self
    {
        $this->productQueryableParameters['collection_id'] = $collectionId;

        return $this;
    }

    public function withCreatedAtMin(Carbon $date = null): self
    {
        $this->productQueryableParameters['created_at_min'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withCreatedAtMax(Carbon $date = null): self
    {
        $this->productQueryableParameters['created_at_max'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withUpdatedAtMin(Carbon $date = null): self
    {
        $this->productQueryableParameters['updated_at_min'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withUpdatedAtMax(Carbon $date = null): self
    {
        $this->productQueryableParameters['updated_at_max'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withPublishedAtMin(Carbon $date = null): self
    {
        $this->productQueryableParameters['published_at_min'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withPublishedAtMax(Carbon $date = null): self
    {
        $this->productQueryableParameters['published_at_max'] = optional($date)->toIso8601String();

        return $this;
    }

    public function withPublishedStatusAny(): self
    {
        $this->productQueryableParameters['published_status'] = null;

        return $this;
    }

    public function withPublishedStatusPublished(): self
    {
        $this->productQueryableParameters['published_status'] = 'published';

        return $this;
    }

    public function withPublishedStatusUnpublished(): self
    {
        $this->productQueryableParameters['published_status'] = 'unpublished';

        return $this;
    }

    public function withFields($fields = null): self
    {
        $this->productQueryableParameters['fields'] = (is_array($fields))
            ? implode(',', $fields)
            : null;

        return $this;
    }

    public function withPresentmentCurrencies($currencies = null): self
    {
        $this->productQueryableParameters['presentment_currencies'] = (is_array($currencies))
            ? implode(',', $currencies)
            : null;

        return $this;
    }

    public function getProductQueryableParameters(): array
    {
        return array_filter($this->productQueryableParameters);
    }
}
