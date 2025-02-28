<?php

declare(strict_types=1);

namespace AndrewBroberg\WHMCS;

use AndrewBroberg\WHMCS\Resources\InvoiceResource;
use AndrewBroberg\WHMCS\Resources\TransactionsResource;
use Saloon\Contracts\Body\HasBody;
use Saloon\Http\Connector;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;

class WhmcsConnector extends Connector implements HasBody
{
    use AcceptsJson;
    use AlwaysThrowOnErrors;
    use HasFormBody;

    public function __construct(
        protected string $baseUrl,
        protected string $apiIdentifier,
        protected string $apiSecret,
    ) {}

    /**
     * The Base URL of the API
     */
    public function resolveBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function transactions(): TransactionsResource
    {
        return new TransactionsResource($this);
    }

    public function invoices(): InvoiceResource
    {
        return new InvoiceResource($this);
    }

    /**
     * @return array<string, string>
     */
    protected function defaultBody(): array
    {
        return [
            'identifier' => $this->apiIdentifier,
            'secret' => $this->apiSecret,
            'responsetype' => 'json',
        ];
    }

    public function hasRequestFailed(Response $response): ?bool
    {
        $status = $response->json('result');

        if ($status !== 'success') {
            return true;
        }

        return null;
    }
}
