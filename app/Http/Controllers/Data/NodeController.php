<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\Data\Node;
use App\Models\Data\NodeTypes;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NodeController extends Controller
{
  public function index(): JsonResponse
  {
    $results = Node::paginate(10);

    return response()->json($results);
  }


  public function store(Request $request): JsonResponse
  {
    $validated = $request->validate([
      'name' => 'required|string',
      'data_type' => ['required', Rule::in(NodeTypes::keys())],
      'description' => 'nullable|string',
    ]);

    $result = Node::create($validated);

    return response()->json($result, 201);
  }


  public function show(Node $node): JsonResponse
  {
    return response()->json($node);
  }


  public function update(Request $request, Node $node): JsonResponse
  {
    $validated = $request->validate([
      'name' => 'required|string',
      'data_type' => ['required', Rule::in(NodeTypes::keys())],
      'description' => 'required|string',
    ]);

    $node->update($validated);

    return response()->json($node);
  }


  public function destroy(Node $node): JsonResponse
  {
    $node->delete();
    return response()->json($node);
  }
}
