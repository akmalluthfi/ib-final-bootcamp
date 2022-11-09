<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
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

        return response()->json([
            'message' => 'Success get Customers',
            'data' => CustomerResource::collection($customers),
            'errors' => null
        ]);
    }
}
