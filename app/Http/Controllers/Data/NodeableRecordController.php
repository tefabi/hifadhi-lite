<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Data\Node;
use App\Models\Data\NodeableRecord;
use App\Models\Data\NodeTypes;
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
      'record' => 'required'
    ]);

    $node =  Node::find($fields['node_id']) // --
      ->append('node_type');

    $record_instance = $node->node_type->class_instance();
    $record_instance->record = $fields['record'];
    $record_instance->save();

    $result = [
      'node' => $node,
      'result' => NodeTypes::from($node->data_type)->class_name(),
      'record' => $record_instance
    ];


    return response()->json($result, 201);
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
