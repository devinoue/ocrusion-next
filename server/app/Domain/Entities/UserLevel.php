<?php

namespace App\Domain\Entities;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\UserLevel\Level;
use App\Domain\ValueObject\UserLevel\Times;

final class UserLevel
{
  private $userId;
  private $times;
  private $level;
  private $remainingTime;
  private $limitSize;

  private $SECONDS_IN_A_DAY = 24 * 60 * 60;

  public function __construct(UserId $userId, Times $times, Level $level)
  {
    $this->userId = $userId;
    $this->level = $level;
    $this->times = $times;

    $this->limitSize = $this->getLimitSize();
  }

  public function getUserId(): int
  {
    return $this->userId->value();
  }

  public function getTimes(): array
  {
    return $this->times->value();
  }

  public function getLevel(): int
  {
    return $this->level->value();
  }

  public function getRemainingTime(): string
  {
    return $this->remainingTime;
  }

  private function getLimitSize(): int
  {
    switch ($this->getLevel()) {
      case 0: //
        return 300000;
        break;
      case 1: //
        return 300000;
        break;
      default:
        return 0;
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
  }


  public function checkLimit(): bool
  {
    $now = time();
    $SECONDS_IN_A_DAY = $this->SECONDS_IN_A_DAY;

    if (!isset($this->times->value[0])) {
      return true;
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
      return false;
    }

    $this->remainingTime = 0;
    return true;
  }

  private function updateTimes()
  {
    $now = time();
    $SECONDS_IN_A_DAY = $this->SECONDS_IN_A_DAY;
    $tmpTimesArray = [];
    foreach ($this->times->value as $key => $value) {
      if ($key > ($now - $SECONDS_IN_A_DAY)) {
        $tmpTimesArray[$key] = value;
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
