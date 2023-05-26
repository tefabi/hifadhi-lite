<?php

use App\Http\Controllers\Data\NodeableRecordController;
use App\Http\Controllers\Data\NodeController;
use App\Http\Controllers\Data\NodeHierarchyController;
use App\Http\Controllers\Data\NodeHierarchyRecordController;
use Illuminate\Support\Facades\Route;

Route::apiResource('nodes', NodeController::class)->names('nodes');

Route::apiResource('nodeable_records', NodeableRecordController::class) // --
  ->names('nodeable_records');

Route::apiResource('node_hierarchies', NodeHierarchyController::class) // --
  ->names('node_hierarchies');

Route::apiResource('node_hierarchy_records', NodeHierarchyRecordController::class) // --
  ->names('node_hierarchy_records');
