<?php

declare(strict_types=1);

namespace AndrewBroberg\WHMCS\Requests;

class GetTransactions extends BaseRequest
{
    public function __construct(
        protected ?int $clientId,
        protected ?int $invoiceId,
        protected ?string $transactionId,
    ) {}

    public function defaultBody(): array
    {
        return [
            'action' => 'GetTransactions',
            'transid' => $this->transactionId,
            'clientid' => $this->clientId,
            'invoiceid' => $this->invoiceId,
        ];
    }
}
