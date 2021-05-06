<?php

namespace EolabsIo\ShopifyRestAdminApi\Domain\Shared;

use Illuminate\Support\Str;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\HasAuthHeaders;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\HasPaginatedResults;
use EolabsIo\ShopifyRestAdminApi\Domain\Shared\Concerns\InteractsWithBaseUrl;

abstract class ShopifyCore
{
    use HasAuthHeaders,
        InteractsWithBaseUrl,
        HasPaginatedResults;

    public function __construct()
    {
    }

    public function getUrl(string $endpoint): string
    {
        return $this->getBaseUrl() . Str::start($endpoint, '/');
    }

    abstract public function fetch();

    public function get(string $endpoint, array $parameters = [])
    {
        try {
            if ($this->hasNextPage()) {
                parse_str(Str::after($this->getNextPageUrl(), '?'), $parameters);
            }

            $headers = $this->getHeaderFields();
            $response = Http::withHeaders($headers)
                            ->get($this->getUrl($endpoint), $parameters)
                            ->throw();

            return $this->processResponse($response);
        } catch (RequestException $requestException) {
            $this->handleException($requestException);
        }
    }

    public function post(string $endpoint, array $parameters = [])
    {
        try {
            $headers = $this->getHeaderFields();
            $response = Http::withHeaders($headers)
                            ->post($this->getUrl($endpoint), $parameters)
                            ->throw();

            return $this->processResponse($response);
        } catch (RequestException $requestException) {
            $this->handleException($requestException);
        }
    }

    public function delete(string $endpoint, array $parameters = [])
    {
        try {
            $headers = $this->getHeaderFields();
            $response = Http::withHeaders($headers)
                            ->delete($this->getUrl($endpoint), $parameters)
                            ->throw();

            return $this->processResponse($response);
        } catch (RequestException $requestException) {
            $this->handleException($requestException);
        }
    }

    public function processResponse(Response $response)
    {
        $this->processPaginatedResults($response);
        $results = collect(json_decode($response->getBody(), true));

        return $results;
    }

    /**
     * Get the Header fields for the token request.
     *
     * @return array
     */
    protected function getHeaderFields(): array
    {
        return array_merge($this->getAuthHeaders(), ['Accept' => 'application/json']);
    }

    protected function handleException(RequestException $requestException)
    {
        $status = $requestException->response->status();
        switch ($status) {
            default:
                throw $requestException;
        }
    }
}
