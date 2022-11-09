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
        return $this->vendorRepository->searchAndFind($search);
    }
}
