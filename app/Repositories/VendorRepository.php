<?php

namespace App\Repositories;

use App\Models\Vendor;

class VendorRepository
{
    public function searchAndFind($search)
    {
        return Vendor::latest()
            ->where('name', 'like', "%$search%")
            ->limit(10)
            ->get(['name', 'addresses']);
    }

    public function getAll()
    {
        return Vendor::latest()->limit(10)->get(['name', 'addresses']);
    }

    public function addAddress($vendor, $addres)
    {
        $vendor = $vendor->push('addresses', $addres, true);

        return $vendor;
    }
}
