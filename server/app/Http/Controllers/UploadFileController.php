<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UseCase\UploadFileUseCase;

class UploadFileController extends Controller
{
    public function __invoke(Request $request)
    {
        $usecase = new UploadFileUseCase();
        $result = $usecase->execute($request);
        return $result;
    }
}
