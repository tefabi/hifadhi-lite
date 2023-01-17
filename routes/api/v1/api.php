<?php

use App\Http\Controllers\Data\NodeController;
use Illuminate\Support\Facades\Route;

Route::apiResource('nodes', NodeController::class)->names('nodes');
