<?php

namespace App\Http\Controllers;

use App\UseCase\DeleteExpiredIDirUseCase;

final class DeleteExpiredImgDirController extends Controller
{
    public function __invoke()
    {
        $deleteExpiredIDirUseCase = new DeleteExpiredIDirUseCase();
        $result = $deleteExpiredIDirUseCase->execute();
        return $result;
    }
}
