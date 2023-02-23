<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

  protected function nodeType(): Attribute
  {
    return new Attribute(get: fn () => NodeTypes::from($this->data_type));
  }

  public function nodeableRecords()
  {
    return $this->hasMany(NodeableRecord::class, 'node_id');
  }
}
