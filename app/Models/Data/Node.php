<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Node extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'name',
    'data_type',
    'description'
  ];

  public function nodeableRecords()
  {
    return $this->hasMany(NodeableRecord::class, 'node_id');
  }
}
