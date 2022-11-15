<?php

namespace App\Services;

use App\Exceptions\SearchNotFoundException;
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

        $customers = $this->customerRepository->searchAndFind($search);

        if ($customers->count() <= 0) throw new SearchNotFoundException('Customer not found');

        return $customers;
    }
}
