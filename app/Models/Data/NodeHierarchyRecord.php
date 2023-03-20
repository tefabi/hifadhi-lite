<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NodeHierarchyRecord extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'node_hierarchy_id',
    'nodeable_record_id',
  ];

  public function nodeHierarchy()
  {
    return $this->belongsTo(NodeHierarchy::class, 'node_hierarchy_id');
  }


  public function nodeableRecord()
  {
    return $this->belongsTo(NodeableRecord::class, 'nodeable_record_id');
  }
}
