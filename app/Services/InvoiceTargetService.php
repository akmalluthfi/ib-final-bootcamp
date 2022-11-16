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
        if (is_null($search)) return $this->invoiceTargetRepository->getAll();

        return $this->invoiceTargetRepository->searchAndFind($search);
    }

    public function storeInvoiceTarget($invoiceTarget)
    {
        return $this->invoiceTargetRepository->storeInvoiceTarget($invoiceTarget);
    }
}
