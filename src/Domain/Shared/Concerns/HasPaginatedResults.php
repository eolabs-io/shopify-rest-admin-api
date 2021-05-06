<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns;

use Illuminate\Support\Str;
use Illuminate\Http\Client\Response;

trait HasPaginatedResults
{
    private $link = [
        'next' => null,
        'prev' => null,
    ];

    public function processPaginatedResults(Response $response)
    {
        if ($response->hasHeader('Link')) {
            $header = $response->header('Link');
            $this->processLinkHeader($header);
        }
    }

    public function hasPreviousPage(): bool
    {
        return filled($this->link['prev']);
    }

    public function getPreviousPageUrl(): ?string
    {
        return $this->link['prev'];
    }

    public function hasNextPage(): bool
    {
        return filled($this->link['next']);
    }

    public function getNextPageUrl(): ?string
    {
        return $this->link['next'];
    }

    private function processLinkHeader($header)
    {
        $paginationLinks = Str::of($header)
            ->explode(',')
            ->flatMap(function ($value) {
                $values = Str::of($value)->explode(';');
                $key = (string) Str::of(data_get($values, 1))->after('rel=')->remove('"');
                $value = Str::between(data_get($values, 0), '<', '>');

                return [$key => $value];
            });

        $this->link['next'] = data_get($paginationLinks, 'next');
        $this->link['prev'] = data_get($paginationLinks, 'prev');
    }
}
