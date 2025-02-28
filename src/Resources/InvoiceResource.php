<?php

declare(strict_types=1);

namespace AndrewBroberg\WHMCS\Resources;

use AndrewBroberg\WHMCS\DataTransferObjects\Invoice;
use AndrewBroberg\WHMCS\Requests\GetInvoice;
use DateTimeImmutable;
use Saloon\Http\BaseResource;

class InvoiceResource extends BaseResource
{
    public function get(int $invoiceId): Invoice
    {
        $response = $this->connector->send(new GetInvoice($invoiceId));

        return new Invoice(
            id: $response->json('invoiceid'),
            invoiceNum: $response->json('invoicenum'),
            userId: (int) $response->json('userid'),
            date: new DateTimeImmutable($response->json('date')),
            dueDate: new DateTimeImmutable($response->json('duedate')),
            datePaid: new DateTimeImmutable($response->json('datepaid')),
            lastCaptureAttempt: new DateTimeImmutable($response->json('lastcaptureattempt')),
            subTotal: (float) $response->json('subtotal'),
            credit: (float) $response->json('credit'),
            tax: (float) $response->json('tax'),
            tax2: (float) $response->json('tax2'),
            taxRate: (float) $response->json('taxrate'),
            taxRate2: (float) $response->json('taxrate2'),
            balance: (float) $response->json('balance'),
            total: (float) $response->json('total'),
            status: $response->json('status'),
            paymentMethod: $response->json('paymentmethod'),
            notes: $response->json('notes'),
        );
    }
}
