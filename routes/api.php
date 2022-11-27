<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\InvoiceTargetController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\VendorInvoiceController;
use App\Models\Instruction;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/test', function () {
    $instruction = Instruction::firstOrFail();

    dd(str_pad('0123', 2, '0', STR_PAD_LEFT));

    return new App\Http\Resources\InstructionResource($instruction, 'Successfully Get All Instruction');
});

Route::apiResource('/instructions', InstructionController::class)->except([
    'destroy'
]);

Route::patch('/instructions/{instruction}/receive', [InstructionController::class, 'receive']);

Route::apiResource('instructions.vendor-invoices', VendorInvoiceController::class)->except([
    'index'
])->parameters([
    'vendor-invoices' => 'id'
]);

Route::patch('instructions/{instruction}/terminate', [InstructionController::class, 'terminate']);

Route::get('/vendors', [VendorController::class, 'index'])->name('vendor.index');

Route::post('/vendors/{vendor}/addresses', [VendorController::class, 'addAddress'])->name('vendor.add-address');

Route::get('/invoice-targets', [InvoiceTargetController::class, 'index'])->name('invoice-target.index');

Route::post('/invoice-targets', [InvoiceTargetController::class, 'store'])->name('invoice-target.store');

Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');

Route::get('/transactions', [TransactionController::class, 'index'])->name('transaction.index');

Route::apiResource('/recipients', RecipientController::class)->except([
    'destroy'
]);

// Handle route api doesn't exists
Route::get('/{any}', function (Request $request) {
    if ($request->expectsJson()) {
        return response()->json([
            'message' => 'Not Found'
        ], 404);
    }
});
