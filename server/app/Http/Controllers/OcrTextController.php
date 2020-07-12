<?php

namespace App\Http\Controllers;

use App\UseCase\OcrText\OcrTextEditUseCase;
use Illuminate\Http\Request;

class OcrTextController extends Controller
{
    public function edit(Request $request, $bookId)
    {
        // 送信されてきたocr_textだけ更新する。送信されてきていないものは無視
        // book_idとimg_pathで同一性を確保
        $ocrTextEditUseCase = new OcrTextEditUseCase();
        return $ocrTextEditUseCase->execute($bookId, $request->ocrTexts);
    }
}
