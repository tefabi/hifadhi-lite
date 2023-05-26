<?php

namespace Tests\Feature\Controllers\Data;

use App\Http\Controllers\Data\NodeHierarchyController;
use App\Models\Data\Node;
use App\Models\Data\NodeHierarchy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class NodeHierarchyControllerTest extends TestCase
{
  use RefreshDatabase;

  public function test_can_get_node_hierarchy_list(): void
  {
    $node = Node::factory()->create();

    NodeHierarchy::create([
      'node_id' => $node->id,
      'hierarchy' => '1/2/3',
      'quantity_type' => NodeHierarchy::QUANTITY_SINGLE
    ]);

    $response = $this->getJson(
      action([NodeHierarchyController::class, 'index'])
    );

    $response->assertJson(
      fn (AssertableJson $json) =>
      $json->has('data.0.node')
        ->where('total', 1)
        ->etc()
    );

    $response->assertStatus(200);
  }
}
