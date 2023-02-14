<?php

use App\Http\Controllers\Data\NodeController;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;

uses(RefreshDatabase::class);

it('can get node definition list', function () {
  $response = getJson(
    action([NodeController::class, 'index'])
  );

  $response->assertStatus(200);
});


it('can post node definition', function () {
  $response = postJson(
    '/api/v1/nodes/'
  );

  $response->assertStatus(201);
});
