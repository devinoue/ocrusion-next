<?php

namespace App\Domain\ValueObject\UserLevel;

use App\Domain\ValueObject\BaseValueObject;

final class Times implements BaseValueObject
{
    public array $value;

    public function __construct(array $primitive)
    {
        $this->validate($primitive);
        $this->value = $primitive;
    }

    public static function create(array $primitive): Times
    {
        $instance = new Times($primitive);
        return $instance;
    }

    public function setValue(int $time, int $value)
    {

        $this->value[$time] = $value;

    }
    private function validate($primitive)
    {
        // validation
    }

    public function setTimes(array $times)
    {
        $this->value = $times;
    }

    public static function splitTimes(string $stringTimes): array
    {
        $explodedTimes = explode("/", $stringTimes);

        $sizeTimeSet = [];
        if (!isset($explodedTimes[0])) return $sizeTimeSet;
        foreach ($explodedTimes as $value) {
            $explodedValue = explode("-", $value);
            if (!isset($explodedValue[1])) continue;
            $sizeTimeSet[$explodedValue[0]] = $explodedValue[1];
        }
        return $sizeTimeSet;
    }

    public function joinTimes(): string
    {
        $sizeTimeSet = $this->value;
        $stringTimes = "";
        foreach ($sizeTimeSet as $key => $value) {
            $stringTimes .= $key . "-" . $value;
            $stringTimes .= "/";
        }
        return $stringTimes;
    }

    public function value(): array
    {
        return $this->value;
    }
}
