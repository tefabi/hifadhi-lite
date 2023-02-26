<?php

namespace Tests\Feature\Controllers\Data;

use App\Http\Controllers\Data\NodeableRecordController;
use App\Models\Data\Node;
use App\Models\Data\NodeTypes;
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

    $record_data = $this->faker->word;
    $response = $this->postJson(
      action([NodeableRecordController::class, 'store']),
      ['node_id' => $node->id, 'record' => $record_data]
    );

    $table_name = $node->node_type->class_instance()->getTable();

    // For the data type
    $this->assertDatabaseHas($table_name, ['record' => $record_data]);

    // For the nodeble record
    $this->assertDatabaseHas(
      'nodeable_records',
      [
        'node_id' => $node->id,
        'nodeable_type' => $node->node_type->class_name()
      ]
    );

    $response->assertStatus(201);
  }


  public function test_can_not_post_invalid_node_id_to_node_record(): void
  {
    $record_data = $this->faker->word;
    $response = $this->postJson(
      action([NodeableRecordController::class, 'store']),
      ['node_id' => -1, 'record' => $record_data]
    );

    $response->assertInvalid(['node_id']);
  }

  public function test_can_not_post_invalid_record_to_node_record(): void
  {
    $node = Node::factory()->create(['data_type' => NodeTypes::T_STRING->value]);

    $record_data = $this->faker->emoji;
    $response = $this->postJson(
      action([NodeableRecordController::class, 'store']),
      [
        'node_id' => $node->id, // --
        'record' => $record_data
      ]
    );

    $response->assertInvalid(['record']);
  }
}
