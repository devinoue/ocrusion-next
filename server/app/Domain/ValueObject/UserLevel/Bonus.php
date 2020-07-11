<?php

namespace App\Domain\ValueObject\UserLevel;

use App\Domain\ValueObject\BaseValueObject;

final class Bonus implements BaseValueObject
{
    public $value;

    public function __construct(int $primitive)
    {
        $this->validate($primitive);
        $this->value = $primitive;
    }

    public static function create(int $primitive): Bonus
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
