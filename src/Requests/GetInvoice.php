<?php

declare(strict_types=1);

namespace AndrewBroberg\WHMCS\Requests;

use AndrewBroberg\WHMCS\DataTransferObjects\Invoice;
use DateTimeImmutable;
use Saloon\Http\Response;

class GetInvoice extends BaseRequest
{
    public function __construct(
        protected int $invoiceId,
    ) {}

    /**
     * @return Invoice
     */
    public function createDtoFromResponse(Response $response): mixed
    {
        return new Invoice(
            invoiceId: $response->json('invoiceid'),
            date: DateTimeImmutable::createFromFormat('Y-m-d', $response->json('date')),
            dueDate: DateTimeImmutable::createFromFormat('Y-m-d', $response->json('duedate')),
            total: $response->json('total'),
            balance: $response->json('balance'),
            status: $response->json('status'),
        );
    }

    public function defaultBody(): array
    {
        return [
            'action' => 'GetInvoice',
            'invoiceid' => $this->invoiceId,
        ];
    }
}
