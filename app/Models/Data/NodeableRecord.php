<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NodeableRecord extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'node_id',
    'nodeable_id',
    'nodeable_type',
  ];

  public function nodeable()
  {
    return $this->morphTo();
  }

  public function node()
  {
    return $this->belongsTo(Node::class, 'node_id');
  }
}
