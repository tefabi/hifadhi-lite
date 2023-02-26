<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Data\Node;
use App\Models\Data\NodeableRecord;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NodeableRecordController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(): JsonResponse
  {
    $results = NodeableRecord::with('node', 'nodeable')->paginate(10);

    return response()->json($results);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request): JsonResponse
  {
    $fields = $request->validate([
      'node_id' => 'required|int|exists:nodes,id',
    ]);

    $node =  Node::find($fields['node_id']) // --
      ->append('node_type');

    $record_instance = $node->node_type->class_instance();

    $record_fields = $request->validate( // --
      [
        'record' => $record_instance->getValidationRules()
      ]
    );

    $record_instance->record = $record_fields['record'];
    $record_instance->save();

    $nodeable_record = new NodeableRecord();
    $nodeable_record->node_id = $node->id;
    $nodeable_record->nodeable_id = $record_instance->id;
    $nodeable_record->nodeable_type = $node->node_type->class_name();
    $nodeable_record->save();

    return response()->json($nodeable_record, 201);
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    //
  }


  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
    //
  }
}
