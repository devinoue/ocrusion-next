<?php

namespace App\Http\Controllers;

use App\UseCase\Upload\UploadCapacityUseCase;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function capacity(string $userId)
    {
        $uploadCapacityUseCase = new UploadCapacityUseCase();
        return $uploadCapacityUseCase->execute($userId);
    }
}
