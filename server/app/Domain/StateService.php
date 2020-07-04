<?php

namespace App\Domain;

use App\Domain\Entities;

use App\Domain\ValueObject\BookId;
use App\Domain\ValueObject\UserId;
use App\Repository\DB\QueueRepository;
use App\Repository\DB\StateRepository;

/**
 * 待ち順番の管理をする
 *
 */
class StateService
{
    private BookId $bookId;
    private UserId $userId;
    private string $executingError;
    private string $createdAt;
    private Entities\Queue $queue;
    private QueueRepository $queueRepository;
    private StateRepository $stateRepository;

    public function __construct()
    {
        $this->queueRepository = new QueueRepository();
        $this->stateRepository = new StateRepository();
        $this->executingError = "";
        $this->createdAt = "";
    }

    public function getBookId():string
    {
        return $this->queue->getBookId();
    }
    public function getUserId():int
    {
        return $this->queue->getUserId();
    }
    public function getError():string
    {
        return $this->executingError;
    }


    public function isExecuting():bool
    {
        try {
            $this->queue = $this->queueRepository->first();
            $this->bookId = new BookId($this->queue->getBookId());
            $this->userId = new UserId($this->queue->getUserId());
        } catch (\Exception $e) {
            return false;
        }
        try {
            $state = $this->stateRepository->first();
            $this->createdAt = $state->getCreatedAt();
        } catch (\Exception $e) {
            return false;
        }

        $exe_time_in_seconds = time() - strtotime($this->createdAt);

        if ($exe_time_in_seconds > env("MAX_OCR_EXECUTE_SECONDS", 5*60)) {
            // 5分を超えていたら不正終了したと判断してstatesテーブルから消す。
            $this->stateRepository->delete();
            $this->isRunningError = "不正入力があります";
            return false;
        }
        return true;
    }

    public function lock()
    {

        $state = new Entities\State($this->userId, $this->bookId, $this->createdAt);
        $this->stateRepository->save($state);

    }

    public function clear()
    {
        $this->queueRepository->delete($this->bookId);
        $this->stateRepository->delete();
    }

    public function exceptionUnlock()
    {
        $this->stateRepository->delete();
    }
}
