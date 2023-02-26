<?php

namespace Tests\Feature\Controllers\Data;

use App\Http\Controllers\Data\NodeableRecordController;
use App\Models\Data\Node;
use App\Models\Data\NodeableRecord;
use App\Models\Data\NodeTypes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class NodeableRecordControllerTest extends TestCase
{
  use WithFaker;
  use RefreshDatabase;

  public function test_can_get_node_record_list(): void
  {
    $node = Node::factory()->create(['data_type' => NodeTypes::T_STRING->value]);

    $length = $this->faker->numberBetween(1, 20);

    for ($i = 0; $i < $length; $i++) {
      $record_instance = $node->node_type->class_instance();

      $record_instance->record = $this->faker->word;
      $record_instance->save();

      $nodeable_record = new NodeableRecord();
      $nodeable_record->node_id = $node->id;
      $nodeable_record->nodeable_id = $record_instance->id;
      $nodeable_record->nodeable_type = $node->node_type->class_name();
      $nodeable_record->save();
    }

    $response = $this->getJson(action([NodeableRecordController::class, 'index']));

    $response->assertJson(
      fn (AssertableJson $json) =>
      $json->has('data.0.node')
        ->has('data.0.nodeable')
        ->where('total', $length)
        ->etc()
    );

    $response->assertStatus(200);
  }

  public function test_can_post_nodeable_record(): void
  {
    $node = Node::factory()->create(['data_type' => NodeTypes::T_STRING->value]);

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

  public function test_can_get_single_node_record(): void
  {
    $node = Node::factory()->create(['data_type' => NodeTypes::T_STRING->value]);

    $record_instance = $node->node_type->class_instance();

    $record_instance->record = $this->faker->word;
    $record_instance->save();

    $nodeable_record = new NodeableRecord();
    $nodeable_record->node_id = $node->id;
    $nodeable_record->nodeable_id = $record_instance->id;
    $nodeable_record->nodeable_type = $node->node_type->class_name();
    $nodeable_record->save();


    $response = $this->getJson(action(
      [NodeableRecordController::class, 'show'], // --
      $nodeable_record->id
    ));


    $response->assertJson(
      fn (AssertableJson $json) =>
      $json->has('node')
        ->has('nodeable')
        ->where('nodeable.record', $record_instance->record)
        ->etc()
    );

    $response->assertSuccessful();
  }


  public function test_can_not_get_non_existent_node_record(): void
  {
    $response = $this->getJson(action(
      [NodeableRecordController::class, 'show'], // --
      -1
    ));

    $response->assertStatus(404);
  }


  public function test_can_delete_node_record(): void
  {
    $node = Node::factory()->create(['data_type' => NodeTypes::T_STRING->value]);

    $record_instance = $node->node_type->class_instance();

    $record_instance->record = $this->faker->word;
    $record_instance->save();

    $nodeable_record = new NodeableRecord();
    $nodeable_record->node_id = $node->id;
    $nodeable_record->nodeable_id = $record_instance->id;
    $nodeable_record->nodeable_type = $node->node_type->class_name();
    $nodeable_record->save();

    $response = $this->deleteJson(action(
      [NodeableRecordController::class, 'destroy'], // --
      $nodeable_record->id
    ));

    $this->assertSoftDeleted($nodeable_record);
    $this->assertSoftDeleted($record_instance);

    $response->assertStatus(200);
  }
}
