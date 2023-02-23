<?php

use App\Http\Controllers\Data\NodeableRecordController;
use App\Http\Controllers\Data\NodeController;
use Illuminate\Support\Facades\Route;

Route::apiResource('nodes', NodeController::class)->names('nodes');

Route::apiResource('nodeable_records', NodeableRecordController::class) // --
  ->names('nodeable_records');
