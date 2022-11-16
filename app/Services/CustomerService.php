<?php

namespace App\Services;

use App\Repositories\CustomerRepository;

class CustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getCustomer($search)
    {
        if (is_null($search)) return $this->customerRepository->getAll();

        return $this->customerRepository->searchAndFind($search);
    }
}
