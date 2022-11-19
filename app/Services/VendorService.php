<?php

namespace App\Services;

use App\Repositories\VendorRepository;

class VendorService
{
    protected $vendorRepository;

    public function __construct(VendorRepository $vendorRepository)
    {
        $this->vendorRepository = $vendorRepository;
    }

    public function getVendor($search)
    {
        if (is_null($search)) return $this->vendorRepository->getAll();

        return $this->vendorRepository->searchAndFind($search);
    }

    public function addVendorAddress($vendor, $address)
    {
        return $this->vendorRepository->addAddress($vendor, $address);
    }
}
