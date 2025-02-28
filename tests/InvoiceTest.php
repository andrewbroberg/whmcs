<?php

use AndrewBroberg\WHMCS\Requests\GetInvoice;
use AndrewBroberg\WHMCS\WhmcsConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

use function PHPUnit\Framework\assertSame;

it('can get an invoice', function () {
    $mockClient = new MockClient([
        GetInvoice::class => MockResponse::make([
            'result' => 'success',
            'invoiceid' => 79301,
            'invoicenum' => '',
            'userid' => 2894,
            'date' => '2025-02-16',
            'duedate' => '2025-03-02',
            'datepaid' => '2025-02-28 09:01:08',
            'lastcaptureattempt' => '0000-00-00 00:00:00',
            'subtotal' => '54.55',
            'credit' => '0.00',
            'tax' => '5.45',
            'tax2' => '0.00',
            'total' => '60.00',
            'balance' => '0.00',
            'taxrate' => '10.000',
            'taxrate2' => '0.000',
            'status' => 'Paid',
            'paymentmethod' => 'stripe',
            'notes' => '',
            'ccgateway' => true,
            'items' => [
                'item' => [
                    0 => [
                        'id' => 90907,
                        'type' => 'Hosting',
                        'relid' => 3969,
                        'description' => 'Hosting Plan',
                        'amount' => '60.00',
                        'taxed' => 1,
                    ],
                ],
            ],
            'transactions' => [
                'transaction' => [
                    0 => [
                        'id' => 71066,
                        'userid' => 2894,
                        'currency' => 0,
                        'gateway' => 'stripe',
                        'date' => '2025-02-28 09:01:08',
                        'description' => 'Invoice Payment',
                        'amountin' => '60.00',
                        'fees' => '1.32',
                        'amountout' => '0.00',
                        'rate' => '1.00000',
                        'transid' => 'txn_xxxxxxxxxxxxxxxxxxxxxxxxx',
                        'invoiceid' => 79301,
                        'refundid' => 0,
                    ],
                ],
            ],
        ]),
    ]);

    $whmcs = new WhmcsConnector(
        'test',
        'test',
        'test'
    );
    $whmcs->withMockClient($mockClient);
    $invoice = $whmcs->invoices()->get(79301);

    assertSame(79301, $invoice->id);
});
