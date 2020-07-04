<?php


namespace App\UseCase\Book;

use App\Domain\ValueObject\UserId;
use App\Repository\DB\ImgDirRepository;

class BookListUseCase
{
  function execute(UserId $userId)
  {
    $imgDirRepository = new ImgDirRepository();
    try {
      return $imgDirRepository->listBooks($userId);
    } catch (\Exception $exception) {
      return $exception->getMessage();
    }
  }
}
