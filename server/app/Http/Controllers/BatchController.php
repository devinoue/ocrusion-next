<?php

namespace App\Http\Controllers;

use Exception;
use App\UseCase\OcrUseCase;

class BatchController extends Controller
{
    public function __invoke()
    {
        $usecase = new OcrUseCase();
        $result = $usecase->execute();
        return $result;
    }
}
