<?php

namespace App\Repositories;

use App\Models\Vendor;

class VendorRepository
{
    public function searchAndFind($search)
    {
        $vendors = Vendor::query();

        if (!is_null($search)) {
            $vendors->where('name', 'like', "%$search%");
        }

        return $vendors->get(['name', 'address']);
    }
}
