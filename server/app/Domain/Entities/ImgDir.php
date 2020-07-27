<?php


namespace App\Domain\Entities;

use App\Domain\ValueObject\ImgDir\BookName;
use App\Domain\ValueObject\ImgDir\BookOptions;
use App\Domain\ValueObject\ImgDir\Description;
use App\Domain\ValueObject\ImgDir\FileSize;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\ImgDir\OriginalZip;
use App\Domain\ValueObject\BookId;

final class ImgDir
{
    private UserId $userId;
    private OriginalZip $originalZip;
    private FileSize $fileSize;
    private BookId $bookId;
    private int $state;
    private BookName $bookName;
    private Description $description;
    private BookOptions $bookOptions;


    private $OcrStatus = [
        "UNINITIALIZED" => 0,
        "DONE" => 1,
        "EXCEPTION" => 40
    ];

    public function __construct(
        UserId $userId,
        OriginalZip $originalZip,
        FileSize $fileSize,
        BookId $bookId,
        BookName $bookName,
        Description $description,
        BookOptions $bookOptions
    )
    {
        $this->userId = $userId;
        $this->originalZip = $originalZip;
        $this->fileSize = $fileSize;
        $this->bookId = $bookId;
        $this->state = $this->OcrStatus["UNINITIALIZED"];
        $this->bookName = $bookName;
        $this->description = $description;
        $this->bookOptions = $bookOptions;
        $this->state = $this->OcrStatus['UNINITIALIZED'];

    }

    public function getUserId(): int
    {
        return $this->userId->value();
    }

    public function getOriginalZip(): string
    {
        return $this->originalZip->value();
    }

    public function getFileSize(): int
    {
        return $this->fileSize->value();
    }

    public function getBookId(): string
    {
        return $this->bookId->value();
    }

    public function getBookName(): string
    {
        return $this->bookName->value();
    }

    public function getDescription(): string
    {
        return $this->description->value();
    }

    public function getBookOptions(): string
    {
        return $this->bookOptions->value();
    }

    public function getState(): int
    {
        return $this->state;
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
