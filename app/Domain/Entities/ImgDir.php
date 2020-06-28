<?php


namespace App\Domain\Entities;

use App\Domain\ValueObject\ImgDir\BookName;
use App\Domain\ValueObject\ImgDir\BookOptions;
use App\Domain\ValueObject\ImgDir\Description;
use App\Domain\ValueObject\ImgDir\OpenType;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\ImgDir\OriginalZip;
use App\Domain\ValueObject\BookId;

final class ImgDir
{
  private UserId $userId;
  private OriginalZip $originalZip;
  private BookId $bookId;
  private int $state;
  private BookName $bookName;
  private Description $description;
  private BookOptions $bookOptions;
  private OpenType $openType;

  private $OcrStatus = [
    "UNINITIALIZED" => 0,
    "DONE" => 1,
    "EXCEPTION" => 40
  ];

  public function __construct(
    UserId $userId,
    OriginalZip $originalZip,
    BookId $bookId,
    BookName $bookName,
    Description $description,
    BookOptions $bookOptions,
    OpenType $openType
  )
  {
    $this->userId = $userId;
    $this->originalZip = $originalZip;
    $this->bookId = $bookId;
    $this->state = $this->OcrStatus["UNINITIALIZED"];
    $this->bookName = $bookName;
    $this->description = $description;
    $this->bookOptions = $bookOptions;
    $this->openType = $openType;
  }

  public function getUserId(): int
  {
    return $this->userId->value();
  }

  public function getOriginalZip(): string
  {
    return $this->originalZip->value();
  }

  public function getBookId(): string
  {
    return $this->bookId->value();
  }

  public function changeStateUninitialized()
  {
    return $this->state = $this->OcrStatus["UNINITIALIZED"];
  }

  public function changeStateDone()
  {
    return $this->state = $this->OcrStatus["DONE"];
  }

  public function changeStateException()
  {
    return $this->state = $this->OcrStatus["EXCEPTION"];
  }
}
