<?php

namespace App\Domain\ValueObject\UserLevel;

use App\Domain\ValueObject\BaseValueObject;

final class Level implements BaseValueObject
{
    public $value;
    public function __construct(int $primitive)
    {
        $this->validate($primitive);
        $this->value = $primitive;
    }
    public static function create(int $primitive): Level
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
