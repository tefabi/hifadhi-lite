<?php

namespace App\Models\Data\Records;

use App\Models\Data\NodeableRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StringRecord extends Model
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'record'
  ];

  public function nodeableRecord()
  {
    return $this->morphOne(NodeableRecord::class, 'nodeable');
  }
}
