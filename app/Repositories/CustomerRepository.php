<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    public function getAll()
    {
        return Customer::latest()->limit(10)->get(['name']);
    }

    public function searchAndFind($search)
    {
        return Customer::latest()
            ->where('name', 'like', "%$search%")
            ->limit(10)
            ->get(['name']);
    }
}
