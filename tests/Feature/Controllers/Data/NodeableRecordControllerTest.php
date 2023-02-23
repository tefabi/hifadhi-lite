<?php

namespace Tests\Feature\Controllers\Data;

use App\Http\Controllers\Data\NodeableRecordController;
use App\Models\Data\Node;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NodeableRecordControllerTest extends TestCase
{
  use WithFaker;
  use RefreshDatabase;

  /**
   * A basic feature test example.
   */
  public function test_can_post_nodeable_record(): void
  {
    $node = Node::factory()->create();

    $response = $this->postJson(
      action([NodeableRecordController::class, 'store']),
      ['node_id' => $node->id, 'record' => $this->faker->word]
    );

    dd(json_decode($response->getContent()));
    $response->assertStatus(200);
  }
}
