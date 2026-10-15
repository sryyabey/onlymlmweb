<?php

use App\Http\Controllers\Api\LicenseController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/licenses')->middleware('throttle:licensing')->group(function (): void {
    Route::post('activate', [LicenseController::class, 'activate']);
    Route::post('validate', [LicenseController::class, 'validateLicense']);
    Route::post('heartbeat', [LicenseController::class, 'heartbeat']);
    Route::post('deactivate', [LicenseController::class, 'deactivate']);
});
