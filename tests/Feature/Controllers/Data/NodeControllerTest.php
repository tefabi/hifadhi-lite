<?php

namespace Tests\Feature\Controllers\Data;

use App\Http\Controllers\Data\NodeController;
use App\Models\Data\Node;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Str;
use Tests\TestCase;

class NodeControllerTest extends TestCase
{
  use RefreshDatabase;

  public function test_can_get_node_definition_list()
  {
    $response = $this->getJson(
      action([NodeController::class, 'index'])
    );

    $response->assertStatus(200);
  }

  public function test_can_post_node_definition()
  {
    $node = Node::factory()->create();

    $response = $this->postJson(
      action([NodeController::class, 'store']),
      [
        'name' => $node->name,
        'data_type' => $node->data_type,
        'description' => $node->description,
      ]
    );

    $this->assertDatabaseHas(
      'nodes',
      ['name' => $node->name, 'data_type' => $node->data_type]
    );

    $response->assertStatus(201);
  }

  public function test_can_not_post_invalid_node_definition()
  {
    $response = $this->postJson(
      action([NodeController::class, 'store']),
      [
        'data_type' => Str::random()
      ]
    );

    $response->assertInvalid(['name', 'data_type']);
  }
}
