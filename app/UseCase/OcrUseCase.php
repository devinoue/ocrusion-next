<?php

namespace App\UseCase;

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
    $stateService = new StateService();
    $cloudVision = new CloudVision();

    if ($stateService->isExecuting()) {
      return;
    }

    $error = $stateService->getError();
    if ($error) {
      ErrorLogRepository::save($error, 0, $stateService->getBookId());
    }


    $bookId = new BookId($stateService->getBookId());
    $userId = new UserId($stateService->getUserId());

    $stateService->lock();


    try {
      $ocr_texts = $cloudVision->read($userId, $bookId);
      $ocrTextRepository->saveAll($ocr_texts);

      $stateService->clear($bookId);

      $imgDir = $imgDirRepository->find($bookId);
      $imgDir->changeStateDone();
      $imgDirRepository->updateState($imgDir);

      return ["message" => "success"];
    } catch (\Exception $e) {
      ErrorLogRepository::save($e->getMessage(), $userId->value(), $bookId->value());

      $stateService->exceptionUnlock();

      $imgDir = $imgDirRepository->find($bookId);
      $imgDir->changeStateException();
      $imgDirRepository->updateState($imgDir);

      return ["error" => $e->getMessage()];
    }
  }
}
