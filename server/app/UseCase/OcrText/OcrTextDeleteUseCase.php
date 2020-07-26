<?php

namespace App\UseCase\OcrText;

use App\Domain\ValueObject\BookId;
use App\Repository\DB\OcrTextRepository;
use App\Repository\DB\QueueRepository;

final class OcrTextDeleteUseCase
{
    public function execute($bookId, $imgPaths)
    {
        $queueRepository = new QueueRepository();
        $ocrTextRepository = new OcrTextRepository();
        foreach ($imgPaths as $imgPath) {
            $ocrTextRepository->deleteByImgPath($bookId, $imgPath);
            $queueRepository->delete(new BookId($bookId));
        }
        return ["message" => "success"];
    }
}
