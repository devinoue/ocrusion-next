<?php


namespace App\UseCase\Book;


use App\Domain\ValueObject\BookId;
use App\Repository\DB\ImgDirRepository;

class BookFetchUseCase
{
  function execute(BookId $bookId):array
  {
    $imgDirRepository = new ImgDirRepository();
    try {
      return $imgDirRepository->fetchBook($bookId);
    } catch (\Exception $exception) {
      return ["error" => $exception->getMessage()];
    }

  }
}
