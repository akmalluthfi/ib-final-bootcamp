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
        $addresses = $vendor->addresses;
        $addresses[] = $addres;

        $vendor->addresses = $addresses;
        $vendor->save();

        return $vendor;
    }
}
