<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\getJson;

uses(RefreshDatabase::class);

it('can get node definition list', function () {
  $response = getJson(
    '/api/v1/nodes/'
  );

  $response->assertStatus(200);
});
