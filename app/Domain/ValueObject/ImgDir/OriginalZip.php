<?php

namespace App\Domain\ValueObject\ImgDir;

use App\Domain\ValueObject\BaseValueObject;

final class OriginalZip implements BaseValueObject
{
  private $value;

  public function __construct(string $primitive)
  {
    $this->validate($primitive);
    $this->value = $primitive;
  }

  public static function create(string $primitive): OriginalZip
  {
    return new static($primitive);
  }

  private function validate($primitive)
  {
    // validation
  }

  public function value(): string
  {
    return $this->value;
  }
}
