<?php


namespace App\Domain\Entities;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\FileName;
use App\Domain\ValueObject\BookId;

final class State
{
    private UserId $userId;
    private BookId $bookId;
    private $createdAt;

    public function __construct(UserId $userId, BookId $bookId, $createdAt)
    {
        $this->userId = $userId;
        $this->bookId = $bookId;
        $this->createdAt = $createdAt;
    }

    public function getUserId(): int
    {
        return $this->userId->value();
    }

    public function getBookId(): string
    {
        return $this->bookId->value();
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
