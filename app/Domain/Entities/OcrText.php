<?php


namespace App\Domain\Entities;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\BookId;
use App\Domain\ValueObject\OcrText\ImgPath;
use App\Domain\ValueObject\OcrText\TextData;

final class OcrText
{
  private $userId;
  private $bookId;
  private $imgPath;
  private $textData;

  public function __construct(
    BookId $bookId,
    UserId $userId,
    ImgPath $imgPath,
    TextData $textData
  )
  {
    $this->userId = $userId;
    $this->bookId = $bookId;
    $this->imgPath = $imgPath;
    $this->textData = $textData;
  }

  public function getUserId(): int
  {
    return $this->userId->value();
  }

  public function getBookId(): string
  {
    return $this->bookId->value();
  }

  public function getImgPath(): string
  {
    return $this->imgPath->value();
  }

  public function getTextData(): string
  {
    return $this->textData->value();
  }
}
