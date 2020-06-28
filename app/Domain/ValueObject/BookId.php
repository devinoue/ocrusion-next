<?php

namespace App\Domain\ValueObject;

use App\Domain\ValueObject\BaseValueObject;

final class BookId implements BaseValueObject
{
    private $value;
    public function __construct(string $primitive)
    {
        $this->validate($primitive);
        $this->value = $primitive;
    }

    public static function create(string $primitive): BookId
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
    
    public function dir(): string
    {
        return public_path('tmp/'. $this->value);
    }
}
