<?php

namespace App\Models\Data\Records;

use App\Interfaces\Models\IRecordValidated;
use App\Models\Data\NodeableRecord;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StringRecord extends Model implements IRecordValidated
{
  use HasFactory, SoftDeletes;

  protected $fillable = [
    'record'
  ];

  public function nodeableRecord()
  {
    return $this->morphOne(NodeableRecord::class, 'nodeable');
  }

  public function getValidationRules(): array
  {
    return ['nullable', 'string'];
  }
}
