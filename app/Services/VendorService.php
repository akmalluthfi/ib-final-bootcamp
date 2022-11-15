<?php

namespace App\Services;

use App\Exceptions\SearchNotFoundException;
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

        $vendors = $this->vendorRepository->searchAndFind($search);

        if ($vendors->count() <= 0) throw new SearchNotFoundException("Vendor not found");

        return $vendors;
    }

    public function addVendorAddress($vendor, $address)
    {
        return $this->vendorRepository->addAddress($vendor, $address);
    }
}
