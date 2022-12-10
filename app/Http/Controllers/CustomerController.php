<?php

namespace App\Http\Controllers;

use App\Exceptions\SearchNotFoundException;
use App\Http\Resources\CustomerCollection;
use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index(Request $request)
    {
        $customers = $this->customerService->getCustomer($request->query('search'));

        if ($customers->count() <= 0) throw new SearchNotFoundException('Customer not found');

        return new CustomerCollection($customers);
    }
}
