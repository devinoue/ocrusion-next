<?php


namespace App\Http\Controllers;

use App\Domain\ValueObject\BookId;
use App\Domain\ValueObject\UserId;

use App\UseCase\Book\BookDeleteUseCase;
use App\UseCase\Book\BookFetchUseCase;
use App\UseCase\Book\BookListUseCase;


class BookController extends Controller
{
  function list()
  {
    $userId = 1;
    $usecase = new BookListUseCase();
    return $usecase->execute(new UserId($userId));
  }

  function read(string $id)
  {
    $bookId = new BookId($id);
    $usecase = new BookFetchUseCase($bookId);
    return $usecase->execute();
  }
  function delete(string $id)
  {
    $bookId = new BookId($id);
    $usecase = new BookDeleteUseCase($bookId);
    return $usecase->execute();
  }
}
