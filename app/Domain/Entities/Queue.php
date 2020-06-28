<?php


namespace App\Domain\Entities;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\FileName;
use App\Domain\ValueObject\BookId;

final class Queue
{
    private $userId;
    private $bookId;
    public function __construct(UserId $userId, BookId $bookId)
    {
        $this->userId = $userId;
        $this->bookId = $bookId;
    }

    public function getUserId(): int
    {
        return $this->userId->value();
    }
    public function getBookId(): string
    {
        return $this->bookId->value();
    }
}
