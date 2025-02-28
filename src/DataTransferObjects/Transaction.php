<?php

declare(strict_types=1);

namespace AndrewBroberg\WHMCS\DataTransferObjects;

use DateTimeImmutable;

readonly class Transaction
{
    public function __construct(
        public int $id,
        public int $userId,
        public string $description,
        public float $amountIn,
        public DateTimeImmutable $date,
        public float $fees,
        public float $amountOut,
        public float $rate,
        public ?string $transactionId,
        public ?int $invoiceId,
        public ?int $refundId,
    ) {}
}
