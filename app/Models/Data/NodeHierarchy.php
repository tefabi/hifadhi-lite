<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NodeHierarchy extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'node_id',
    'hierarchy',
    'quantity_type'
  ];


  public function node()
  {
    return $this->belongsTo(Node::class, 'node_id');
  }
}
