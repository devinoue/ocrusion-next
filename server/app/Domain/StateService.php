<?php

namespace App\Domain;

use App\Domain\Entities;

use App\Repository\DB\QueueRepository;
use App\Repository\DB\StateRepository;
use App\Repository\DB\UserLevelRepository;

/**
 * 待ち順番の管理をする
 *
 */
class StateService
{
    private string $executingError;
    private string $createdAt;
    private Entities\Queue $queue;
    private QueueRepository $queueRepository;
    private StateRepository $stateRepository;

    private array $errorQueue;
    private int $maxConcurrentConnection = 10;

    public function __construct()
    {
        $this->queueRepository = new QueueRepository();
        $this->stateRepository = new StateRepository();
        $this->executingError = "";
        $this->createdAt = "";
        $this->errorQueue = [];
    }

    public function getBookId(): string
    {
        return $this->queue->getBookId();
    }

    public function getUserId(): int
    {
        return $this->queue->getUserId();
    }

    public function getError(): array
    {
        return $this->errorQueue;
    }


    public function isMaxExecuting(): bool
    {
        $queues = $this->queueRepository->getExecQueue();
        if (!$queues) return false;

        $saveQueue = [];
        foreach ($queues as $queue) {
            $exe_time_in_seconds = time() - strtotime($queue->getUpdatedAt());
            if ($exe_time_in_seconds > env("MAX_OCR_EXECUTE_SECONDS", 5 * 60)) {
                // 5分を超えていたら不正終了したと判断してstatesテーブルから消し、払い戻す
                $this->queueRepository->remove($queue);

                $userLevelRepository = new UserLevelRepository();
                $userLevel = $userLevelRepository->find($queue->getUserId());
                $userLevel->addBonus(1);
                $userLevelRepository->save($userLevel);

                $saveQueue[] = $queue;
                continue;
            }
            array_push($saveQueue, $queue);
        }


        if (count($saveQueue) >= $this->maxConcurrentConnection) return false;

        return true;
    }

    public function lock()
    {
        $this->queue->changeStatusOcring();
        $this->queueRepository->save($this->queue);
    }

    public function initializeUnOcrQueue()
    {
        $queue = $this->queueRepository->getUnOcredQueue();
        if (!$queue) return null;

        $this->queue = $queue;
        $this->lock();


        return $this->queue;
    }

    public function clear()
    {
        $this->queueRepository->remove($this->queue);
    }
}
