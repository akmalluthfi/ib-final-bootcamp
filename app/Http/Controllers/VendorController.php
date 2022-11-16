<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddVendorAddressRequest;
use App\Http\Resources\VendorCollection;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use App\Services\VendorService;
use Illuminate\Http\Request;
use App\Exceptions\SearchNotFoundException;

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

        if ($vendors->count() <= 0) throw new SearchNotFoundException("Vendor not found");

        return new VendorCollection($vendors);
    }

    public function addAddress(AddVendorAddressRequest $request, Vendor $vendor)
    {
        $vendor = $this->vendorService->addVendorAddress($vendor, $request->post('address'));

        return response()->json([
            'message' => 'Add vendor address successfully',
            'data' => new VendorResource($vendor),
        ], 201);
    }
}
