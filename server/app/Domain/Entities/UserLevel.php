<?php

namespace App\Domain\Entities;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\UserLevel\Bonus;
use App\Domain\ValueObject\UserLevel\Level;
use App\Domain\ValueObject\UserLevel\Times;

final class UserLevel
{
    private $userId;
    private $times;
    private $level;
    private $remainingTime;
    private $limitSize;
    private $bonus;
    private $remainingCapacity;

    private $SECONDS_IN_A_DAY = 24 * 60 * 60;

    public function __construct(UserId $userId, Times $times, Level $level, Bonus $bonus)
    {
        $this->userId = $userId;
        $this->level = $level;
        $this->times = $times;
        $this->bonus = $bonus;
        $this->limitSize = $this->getLimitSize();
    }

    public function getUserId(): string
    {
        return $this->userId->value();
    }

    public function getTimes(): array
    {
        return $this->times->value();
    }

    public function getJoinedTimes(): string
    {
        return $this->times->joinTimes();
    }

    public function getLevel(): int
    {
        return $this->level->value();
    }

    public function getBonus(): int
    {
        return $this->bonus->value();
    }

    public function getRemainingTime(): string
    {
        return $this->remainingTime;
    }

    private function getLimitSize(): int
    {
        switch ($this->getLevel()) {
            case 0: // free plan 50MB
                return 50 * 1024 * 1024;
                break;
            case 1: // special plan 500MB
                return 500 * 1024 * 1024;
                break;
            case 2: // premium plan 10GB
                return 10000 * 1024 * 1024;
                break;
            default:
                return 50 * 1000;
        }
    }


    private function getCurrentTotalSize(): int
    {
        $total = 0;
        foreach ($this->getTimes() as $key => $value) {
            $total += intval($value);
        }
        return $total;
    }

    private function getOldestUnixTime(): int
    {
        return array_key_first($this->getTimes());
    }

    public function addNewBook(int $fileSize)
    {
        $now = time();
        $this->times->value[$now] = $fileSize;
        $this->times->setValue($now, $fileSize);

    }

    public function substractBonus($value)
    {
        $this->bonus = new Bonus($this->bonus->value() - $value);
    }

    public function addBonus($value)
    {
        $this->bonus = new Bonus($this->bonus->value() + $value);
    }

    public function checkOut()
    {
        if ($this->bonus->value() > 0) {
            $this->substractBonus(1);
        }
    }

    public function getRemainingCapacity()
    {
        // 24時間より古いデータはすべて除去する
        $this->updateTimes();

        $currentTotalSize = $this->getCurrentTotalSize();

        // 現在の残り容量を記録
        $this->remainingCapacity = $this->limitSize - $currentTotalSize;
        return $this->remainingCapacity;
    }

    public function isOverLimit(): bool
    {
        $now = time();
        $SECONDS_IN_A_DAY = $this->SECONDS_IN_A_DAY;

        if ($this->bonus->value() > 0) {
            return false;
        }

        if (!isset($this->times->value[0])) {
            return false;
        }
        // 24時間より古いデータはすべて除去する
        $this->updateTimes();

        $currentTotalSize = $this->getCurrentTotalSize();

        $oldestTime = $this->getOldestUnixTime();

        // そのレベルの(一日の)サイズリミット数を超えている？
        $isOverTheLimit = $currentTotalSize >= $this->limitSize;

        // 最古は24時間以内だが、制限回数を越えている場合
        if ($isOverTheLimit) {
            // 回復までの残り時間
            $this->remainingTime = $oldestTime - ($now - $SECONDS_IN_A_DAY);
            return true;
        }

        $this->remainingTime = 0;
        return false;
    }

    private function updateTimes()
    {
        $now = time();
        $SECONDS_IN_A_DAY = $this->SECONDS_IN_A_DAY;
        $tmpTimesArray = [];
        foreach ($this->times->value as $key => $value) {
            if ($key > ($now - $SECONDS_IN_A_DAY)) {
                $tmpTimesArray[$key] = $value;
            }
        }
        $this->times->setTimes($tmpTimesArray);
    }

    public function displayRemainingTime(): string
    {
        $seconds = $this->remainingTime;
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds / 60) % 60);
        $seconds = $seconds % 60;

        $hms = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);

        return $hms;
    }
}
