<?php

namespace App\UseCase;

use App\Repository\DB\QueueRepository;
use Exception;
use App\Repository\Api\CloudVision;

use App\Domain\ValueObject\BookId;
use App\Domain\ValueObject\UserId;

use App\Domain\StateService;
use App\Repository\DB\ErrorLogRepository;
use App\Repository\DB\ImgDirRepository;
use App\Repository\DB\OcrTextRepository;

final class OcrUseCase
{
    private $imgDirRepository;
    private $ocrTextRepository;
    private $stateService;
    private $cloudVision;

    function execute()
    {
        $imgDirRepository = new ImgDirRepository();
        $ocrTextRepository = new OcrTextRepository();
        $queueRepository = new QueueRepository();
        $stateService = new StateService();
        $cloudVision = new CloudVision();

        if ($stateService->isMaxExecuting()) {
            return null;
        }

        $error = $stateService->getError();
        if (count($error)) {
            // 払い戻し
            // ErrorLogRepository::save($error, 0, $stateService->getBookId());
        }

        $queue = $stateService->initializeUnOcrQueue();
        if (!$queue) return null;

        $bookId = new BookId($queue->getBookId());
        $userId = new UserId($queue->getUserId());


        try {
            $ocr_texts = $cloudVision->read($userId, $bookId);
            $ocrTextRepository->saveAll($ocr_texts);

            $stateService->clear();

            $imgDir = $imgDirRepository->find($bookId);
            $imgDir->changeStateDone();
            $imgDirRepository->updateState($imgDir);

            return ["message" => "success"];
        } catch (\Exception $e) {
            ErrorLogRepository::save($e->getMessage(), $userId->value(), $bookId->value());

            $imgDir = $imgDirRepository->find($bookId);
            $imgDir->changeStateException();
            $imgDirRepository->updateState($imgDir);

            return ["error" => $e->getMessage()];
        }
    }
}
