<?php

use App\Http\Controllers\Data\NodeController;
use App\Models\Data\Node;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\assertDatabaseHas;
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
  $node = Node::factory()->create();

  $response = postJson(
    action([NodeController::class, 'store']),
    [
      'name' => $node->name,
      'data_type' => $node->data_type,
      'description' => $node->description,
    ]
  );

  assertDatabaseHas(
    'nodes',
    ['name' => $node->name, 'data_type' => $node->data_type]
  );

  $response->assertStatus(201);
});


it('can not post invalid node definition', function () {
  $response = postJson(
    action([NodeController::class, 'store']),
    [
      'data_type' => Str::random()
    ]
  );

  $response->assertInvalid(['name', 'data_type']);
});
