<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class NodeHierarchyRoot extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name',
    'data_type',
    'description'
  ];

  public function nodeHierarchies(): HasMany
  {
    return $this->hasMany(NodeHierarchy::class, 'node_hierarchy_root_id');
  }
}
