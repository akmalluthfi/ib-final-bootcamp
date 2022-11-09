<?php

namespace App\Repositories;

use App\Models\InvoiceTarget;

class InvoiceTargetRepository
{
    public function searchAndFind($search)
    {
        $vendors = InvoiceTarget::query();

        if (!is_null($search)) {
            $vendors->where('name', 'like', "%$search%");
        }

        return $vendors->get(['name']);
    }

    public function storeInvoiceTarget($invoiceTarget)
    {
        InvoiceTarget::create($invoiceTarget);
    }
}
