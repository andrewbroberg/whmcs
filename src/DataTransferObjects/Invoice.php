<?php

declare(strict_types=1);

namespace AndrewBroberg\WHMCS\DataTransferObjects;

use DateTimeImmutable;

readonly class Invoice
{
    public function __construct(
        public int $id,
        public string $invoiceNum,
        public int $userId,
        public DateTimeImmutable $date,
        public DateTimeImmutable $dueDate,
        public DateTimeImmutable $datePaid,
        public DateTimeImmutable $lastCaptureAttempt,
        public float $subTotal,
        public float $credit,
        public float $tax,
        public float $tax2,
        public float $taxRate,
        public float $taxRate2,
        public float $balance,
        public float $total,
        public string $status,
        public string $paymentMethod,
        public string $notes,
    ) {}
}
