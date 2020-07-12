<?php

namespace App\UseCase\OcrText;

use App\Repository\DB\OcrTextRepository;

final class OcrTextDeleteUseCase
{
    public function execute($bookId, $imgPaths)
    {
        $ocrTextRepository = new OcrTextRepository();
        foreach ($imgPaths as $imgPath) {
            $ocrTextRepository->deleteByImgPath($bookId, $imgPath);
        }
        return ["message" => "success"];
    }
}
