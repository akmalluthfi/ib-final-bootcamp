<?php

namespace App\Http\Controllers;

use App\Http\Resources\VendorResource;
use App\Services\VendorService;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    protected $vendorService;

    public function __construct(VendorService $vendorService)
    {
        $this->vendorService = $vendorService;
    }

    public function index(Request $request)
    {
        $vendors =  $this->vendorService->getVendor($request->query('search'));

        return response()->json([
            'message' => 'Success get vendors',
            'data' => VendorResource::collection($vendors),
            'errors' => null
        ]);
    }
}
