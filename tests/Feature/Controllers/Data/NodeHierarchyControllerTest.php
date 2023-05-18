<?php

namespace Tests\Feature\Controllers\Data;

use App\Http\Controllers\Data\NodeHierarchyController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NodeHierarchyControllerTest extends TestCase
{
  use RefreshDatabase;
  /**
   * A basic feature test example.
   */
  public function test_can_get_node_hierarchy_list(): void
  {
    $response = $this->getJson(
      action([NodeHierarchyController::class, 'index'])
    );

    $response->assertStatus(200);
  }
}
