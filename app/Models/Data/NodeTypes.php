<?php

namespace App\Models\Data;

use App\Models\Data\Records\StringRecord;
use App\Models\Data\Records\TextRecord;

enum NodeTypes: string
{
  case T_STRING = 'string';
  case T_TEXT = 'text';

  public function class_name(): string
  {
    return match ($this) {
      self::T_STRING => StringRecord::class,
      self::T_TEXT => TextRecord::class
    };
  }

  public static function keys(): array
  {
    return  array_map(
      fn (Nodetypes $nodeType) => $nodeType->value,
      NodeTypes::cases()
    );
  }
}
