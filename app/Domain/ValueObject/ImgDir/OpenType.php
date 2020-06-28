<?php


namespace App\Domain\ValueObject\ImgDir;

use App\Domain\ValueObject\BaseValueObject;

final class OpenType implements BaseValueObject
{
  private $value;

  function __construct(int $primitive)
  {
    $this->validate($primitive);
    $this->value = $primitive;
  }

  public static function create(int $primitive): OpenType
  {
    return new static($primitive);

  }

  private function validate($primitive)
  {
    // validation
  }

  public function value(): int
  {
    return $this->value;
  }
}
