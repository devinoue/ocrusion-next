<?php

namespace App\Domain\ValueObject;

use App\Domain\ValueObject\BaseValueObject;

final class UserId implements BaseValueObject
{
    private $value;
    public function __construct(int $primitive)
    {
        $this->validate($primitive);
        $this->value = $primitive;
    }
    public static function create(int $primitive): UserId
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
