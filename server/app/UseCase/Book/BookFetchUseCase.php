<?php


namespace App\UseCase\Book;


use App\Domain\ValueObject\BookId;
use App\Repository\DB\ImgDirRepository;
use App\Repository\DB\OcrTextRepository;

class BookFetchUseCase
{
    function execute(BookId $bookId): array
    {
        $ocrTextRepository = new OcrTextRepository();
        try {
            return $ocrTextRepository->fetchBook($bookId);
        } catch (\Exception $exception) {
            return ["error" => $exception->getMessage()];
        }

    }
}
