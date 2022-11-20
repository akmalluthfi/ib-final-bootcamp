<?php

namespace App\Repositories;

use App\Models\InvoiceTarget;

class InvoiceTargetRepository
{
    public function searchAndFind($search)
    {
        return InvoiceTarget::latest()
            ->where('name', 'like', "%$search%")
            ->limit(10)
            ->get(['name']);
    }

    public function getAll()
    {
        return InvoiceTarget::latest()->get(['name']);
    }

    public function storeInvoiceTarget($invoiceTarget)
    {
        return InvoiceTarget::create($invoiceTarget);
    }
}
