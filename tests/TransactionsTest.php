<?php

use AndrewBroberg\WHMCS\Requests\GetTransactions;
use AndrewBroberg\WHMCS\WhmcsConnector;
use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;

it('can list transactions', function () {
    $mockClient = new MockClient([
        GetTransactions::class => MockResponse::make([
            'result' => 'success',
            'totalresults' => 2,
            'startnumber' => 0,
            'numreturned' => 2,
            'transactions' => [
                'transaction' => [
                    [
                        'id' => '10',
                        'userid' => '1',
                        'currency' => '0',
                        'gateway' => 'paypal',
                        'date' => '2016-01-01 06:41:11',
                        'description' => 'Invoice Payment',
                        'amountin' => '45.90',
                        'fees' => '0.00',
                        'amountout' => '0.00',
                        'rate' => '1.00000',
                        'transid' => '1479732071aad259f3513ec',
                        'invoiceid' => '59',
                        'refundid' => '0',
                    ],
                    [
                        'id' => '10',
                        'userid' => '1',
                        'currency' => '0',
                        'gateway' => 'paypal',
                        'date' => '2016-01-01 06:41:11',
                        'description' => 'Invoice Payment',
                        'amountin' => '45.90',
                        'fees' => '0.00',
                        'amountout' => '0.00',
                        'rate' => '1.00000',
                        'transid' => '1479732071aad259f3513ec',
                        'invoiceid' => '59',
                        'refundid' => '0',
                    ],
                ],
            ],
        ]),
    ]);

    $connector = new WhmcsConnector(
        baseUrl: 'https://test',
        apiIdentifier: 'test',
        apiSecret: 'test',
    );
    $connector->withMockClient($mockClient);

    $transactions = $connector->transactions()->list(clientId: 16);

    $mockClient->assertSent(function (GetTransactions $request) {
        return $request->body()->all() === [
            'action' => 'GetTransactions',
            'transid' => null,
            'clientid' => 16,
            'invoiceid' => null,
        ];
    });
});
