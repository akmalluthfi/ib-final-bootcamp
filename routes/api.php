<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\InvoiceTargetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VendorInvoiceController;

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
    // Test
});

Route::post('auth/register', [UserController::class, 'register'])->name('auth.register');
Route::post('auth/login', [UserController::class, 'login'])->name('auth.login');

/**
 * if you want to activate middleware auth uncomment it 
 */
// Route::middleware(['auth'])->group(function () {
Route::post('auth/refresh', [UserController::class, 'refresh'])->name('auth.refresh');
Route::post('auth/logout', [UserController::class, 'logout'])->name('auth.logout');

Route::apiResource('instructions', InstructionController::class)->except([
    'destroy'
]);
Route::patch('/instructions/{instruction}/receive', [InstructionController::class, 'receive'])->name('instructions.receive');
Route::patch('/instructions/{instruction}/terminate', [InstructionController::class, 'terminate'])->name('instructions.terminate');

Route::apiResource('instructions.vendor-invoices', VendorInvoiceController::class)->except([
    'index'
])->parameters([
    'vendor-invoices' => 'id'
]);

Route::get('/vendors', [VendorController::class, 'index'])->name('vendor.index');
Route::post('/vendors/{vendor}/addresses', [VendorController::class, 'addAddress'])->name('vendor.add-address');

Route::get('/invoice-targets', [InvoiceTargetController::class, 'index'])->name('invoice-target.index');
Route::post('/invoice-targets', [InvoiceTargetController::class, 'store'])->name('invoice-target.store');

Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');

Route::get('/transactions', [TransactionController::class, 'index'])->name('transaction.index');

// Report route
Route::get('/reports/excel', [ReportController::class, 'exportToExcel']);
Route::get('/reports/pdf/{instruction}', [ReportController::class, 'exportToPdf']);

// activate this to
// });

// Handle route api doesn't exists
Route::get('/{any}', function (Request $request) {
    if ($request->expectsJson()) {
        return response()->json([
            'message' => 'Not Found'
        ], 404);
    }
});
