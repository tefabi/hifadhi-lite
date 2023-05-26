<?php

namespace Tests\Feature\Controllers\Data;

use App\Http\Controllers\Data\NodeHierarchyRecordController;
use App\Models\Data\Node;
use App\Models\Data\NodeableRecord;
use App\Models\Data\NodeHierarchy;
use App\Models\Data\NodeHierarchyRecord;
use App\Models\Data\NodeTypes;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NodeHierarchyRecordControllerTest extends TestCase
{
  use RefreshDatabase;

  public function test_can_get_node_hierarchy_record_list(): void
  {
    $node = Node::factory()->create(['data_type' => NodeTypes::T_STRING->value]);
    // --

    $hierarchy = NodeHierarchy::create([
      'node_id' => $node->id,
      'hierarchy' => '1/2/3',
      'quantity_type' => NodeHierarchy::QUANTITY_SINGLE
    ]);

    $record_instance = $node->node_type->class_instance();

    $record_instance->record = fake()->word();
    $record_instance->save();

    $nodeable_record = new NodeableRecord();
    $nodeable_record->node_id = $node->id;
    $nodeable_record->nodeable_id = $record_instance->id;
    $nodeable_record->nodeable_type = $node->node_type->class_name();
    $nodeable_record->save();

    NodeHierarchyRecord::create([
      'node_hierarchy_id' => $hierarchy->id,
      'nodeable_record_id' => $nodeable_record->id
    ]);

    $response = $this->getJson(
      action([NodeHierarchyRecordController::class, 'index'])
    );

    $response->assertStatus(200);
  }
}
