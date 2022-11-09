<?php

use App\Http\Controllers\InstructionController;
use App\Http\Controllers\InvoiceTargetController;
use App\Http\Controllers\VendorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    $text = '69764 Stokes Forges\nPredovichaven, PA 22784';

    // $da = date('Y-m-d H:i:s');
    dump($text);
    dd(stripslashes($text));
});

Route::apiResource('/instructions', InstructionController::class)->except([
    'destroy'
]);

Route::get('/vendors', [VendorController::class, 'index'])->name('vendor.index');
Route::get('/invoice-targets', [InvoiceTargetController::class, 'index'])->name('invoice-target.index');

// Handle route api doesn't exists
Route::get('/{any}', function () {
    return response()->json([
        'message' => 'Not Found'
    ], 404);
});
