<?php


namespace App\Interfaces\Models;

interface IRecordValidated
{
  public function getValidationRules(): array;
}
