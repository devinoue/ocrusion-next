<?php


namespace App\UseCase\Book;

use App\Domain\ValueObject\UserId;
use App\Repository\DB\ImgDirRepository;

class BookListUseCase
{
    function execute(UserId $userId, $page)
    {
        $imgDirRepository = new ImgDirRepository();
        try {
            return $imgDirRepository->listBooks($userId, $page);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
