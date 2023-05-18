<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class NodeHierarchy extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'node_id',
    'hierarchy',
    'quantity_type'
  ];

  const QUANTITY_SINGLE = 'single';
  const QUANTITY_MANY = 'many';


  public function node(): BelongsTo
  {
    return $this->belongsTo(Node::class, 'node_id');
  }

  public function nodeHierarchyRecords(): HasMany
  {
    return $this->hasMany(NodeHierarchyRecord::class, 'node_hierarchy_id');
  }

  public function nodeHierarchyRecord(): HasOne
  {
    return $this->hasOne(NodeHierarchyRecord::class, 'node_hierarchy_id') // --
      ->latestOfMany('created_at');
  }
}
