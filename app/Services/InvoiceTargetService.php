<?php

namespace App\Services;

use App\Exceptions\SearchNotFoundException;
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

        $invoiceTargets = $this->invoiceTargetRepository->searchAndFind($search);

        if ($invoiceTargets->count() <= 0) throw new SearchNotFoundException("Invoice target not found");

        return $invoiceTargets;
    }

    public function storeInvoiceTarget($invoiceTarget)
    {
        return $this->invoiceTargetRepository->storeInvoiceTarget($invoiceTarget);
    }
}
