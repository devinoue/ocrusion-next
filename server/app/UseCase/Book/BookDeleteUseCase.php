<?php


namespace App\UseCase\Book;


use App\Domain\ValueObject\BookId;
use App\Repository\DB\ImgDirRepository;

class BookDeleteUseCase
{
  function execute(BookId $bookId)
  {
    try {
      $imgDirRepository = new ImgDirRepository();
      $imgDirRepository->deleteBook($bookId);
    } catch (\Exception $exception) {
      return ["error" => $exception->getMessage()];
    }
  }
}
