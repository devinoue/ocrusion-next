<?php


namespace App\UseCase\Book;


use App\Domain\ValueObject\BookId;
use App\Repository\DB\ImgDirRepository;
use App\Repository\DB\OcrTextRepository;

class BookDeleteUseCase
{
    function execute(array $bookIds)
    {
        try {
            $imgDirRepository = new ImgDirRepository();
            $imgDirRepository->deletebyBookIds($bookIds);

            $ocrTextRepository = new OcrTextRepository();
            $ocrTextRepository->deleteByBookIds($bookIds);
        } catch (\Exception $exception) {
            return ["error" => $exception->getMessage()];
        }
        return ["message" => "success"];
    }
}
