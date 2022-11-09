<?php

namespace App\Repositories;

use App\Models\Customer;

class CustomerRepository
{
    public function searchAndFind($search)
    {
        $vendors = Customer::query();

        if (!is_null($search)) {
            $vendors->where('name', 'like', "%$search%");
        }

        return $vendors->get(['name']);
    }
}
