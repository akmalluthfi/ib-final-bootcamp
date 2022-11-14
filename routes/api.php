<?php

use App\Http\Controllers\InstructionController;
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

Route::get('detailInstruction/{id}', [InstructionController::class, 'detailInstruction']);
Route::post('terminateInstruction/{id}', [InstructionController::class, 'terminateInstruction']);
