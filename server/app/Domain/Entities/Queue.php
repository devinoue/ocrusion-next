<?php


namespace App\Domain\Entities;

use App\Domain\ValueObject\UserId;

use App\Domain\ValueObject\BookId;

final class Queue
{
    private $userId;
    private $bookId;
    private $isOcring;
    private $updatedAt;

    public function __construct(UserId $userId, BookId $bookId, string $updatedAt = "")
    {
        $this->userId = $userId;
        $this->bookId = $bookId;
        $this->isOcring = false;
        $this->updatedAt = $updatedAt;
    }

    public function getUserId(): int
    {
        return $this->userId->value();
    }

    public function getBookId(): string
    {
        return $this->bookId->value();
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function getIsOcring(): bool
    {
        return $this->isOcring;
    }

    public function changeStatusOcring()
    {
        $this->isOcring = true;
    }
}
