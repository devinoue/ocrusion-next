<?php

namespace App\UseCase\OcrText;

use App\Repository\DB\OcrTextRepository;

final class OcrTextEditUseCase
{
    public function execute($bookId, $ocrTexts)
    {
        $ocrTextRepository = new OcrTextRepository();
        foreach ($ocrTexts as $ocrText) {
            $ocrTextRepository->update($bookId, $ocrText['imgPath'], $ocrText['textData']);
        }
        return ["message" => "success"];
    }
}
