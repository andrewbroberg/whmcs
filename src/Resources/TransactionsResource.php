<?php

declare(strict_types=1);

namespace AndrewBroberg\WHMCS\Resources;

use AndrewBroberg\WHMCS\DataTransferObjects\Transaction;
use AndrewBroberg\WHMCS\Requests\GetTransactions;
use DateTimeImmutable;
use Illuminate\Support\Collection;
use Saloon\Http\BaseResource;

class TransactionsResource extends BaseResource
{
    /**
     * Returns a Collection of transactions matching the filters
     *
     * @return Transaction[]
     */
    public function list(?int $invoiceId = null, ?int $clientId = null, ?string $transactionId = null): Collection
    {
        $response = $this->connector->send(new GetTransactions(
            invoiceId: $invoiceId,
            clientId: $clientId,
            transactionId: $transactionId,
        ));

        return $response->collect('transactions.transaction')
            ->map(function (array $transaction) {
                return new Transaction(
                    id: (int) $transaction['id'],
                    userId: (int) $transaction['userid'],
                    date: new DateTimeImmutable($transaction['date']),
                    description: $transaction['description'],
                    amountIn: (float) $transaction['amountin'],
                    amountOut: (float) $transaction['amountout'],
                    fees: (float) $transaction['fees'],
                    rate: (float) $transaction['rate'],
                    transactionId: (string) $transaction['transid'] ?: null,
                    invoiceId: (int) $transaction['invoiceid'] ?: null,
                    refundId: (int) $transaction['refundid'] ?: null,
                );
            });
    }
}
