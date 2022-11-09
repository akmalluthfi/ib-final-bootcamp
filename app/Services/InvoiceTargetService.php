<?php

namespace App\Services;

use App\Repositories\InvoiceTargetRepository;

class InvoiceTargetService
{
    protected $invoiceTargetRepository;

    public function __construct(InvoiceTargetRepository $invoiceTargetRepository)
    {
        $this->invoiceTargetRepository = $invoiceTargetRepository;
    }

    public function getInvoiceTarget($search)
    {
        return $this->invoiceTargetRepository->searchAndFind($search);
    }
}
