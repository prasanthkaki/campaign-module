<?php

use App\Http\Controllers\Campaign;
use App\Http\Middleware\TokenValidation;
use App\Jobs\CampaignQueueJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware([TokenValidation::class])->group(function() {
    Route::get('/campaigns',[Campaign::class, 'campaignList']);
    Route::post('/campaigns', [Campaign::class, 'createCampaign']);
    Route::post('/campaigns/{id}/share', [Campaign::class, 'shareCampaign']);
    Route::put('/campaign', [Campaign::class, 'updateCampaign']);
    Route::delete('/campaigns/{id}/delete', [Campaign::class, 'deleteCampaign']);
});

Route::post('/campaign-queue', function () {
    CampaignQueueJob::dispatch();
});
