<?php

namespace App\UseCase\Upload;

use Illuminate\Http\Request;

use Validator;
use Exception;

use App\Domain\ValueObject\UserId;

use App\Repository\DB\QueueRepository;
use App\Repository\DB\ImgDirRepository;
use App\Repository\DB\UserLevelRepository;

class UploadCapacityUseCase
{
    private ImgDirRepository $imgDirRepository;
    private $queueRepository;
    private $userLevelRepository;

    public function execute(string $userId)
    {
        $userLevelRepository = new UserLevelRepository();

        // ユーザーの24時間以内のアップロード数をチェック
        $userLevel = $userLevelRepository->find(new UserId($userId));
        $userLevel->isOverLimit();
        return ['capacity' => $userLevel->getRemainingCapacity()];
    }
}
