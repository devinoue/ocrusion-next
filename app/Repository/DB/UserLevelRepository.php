<?php


namespace App\Repository\DB;


use App\UserLevel;

use App\Domain\Entities;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\UserLevel\Level;
use App\Domain\ValueObject\UserLevel\Times;

class UserLevelRepository
{

  public function find(UserId $userId): Entities\UserLevel
  {
    $model = UserLevel::find($userId->value());
    if ($model == null) {
//            throw new \Exception("IDが見つかりません");
      $times = new Times(array());
      $level = new Level(1);
      $userLevel = new Entities\UserLevel($userId, $times, $level);
      return $userLevel;
    }

    $times = new Times(Times::splitTimes($model->times));
    $level = new Level($model->level);
    $userLevel = new Entities\UserLevel($userId, $times, $level);
    return $userLevel;
  }

  public function save(Entities\UserLevel $user_level)
  {
    $model = UserLevel::find($user_level->getUserId());
    $joinedTimes = join("/", $user_level->getTimes());
    $model->times = $joinedTimes;
    $model->save();
  }
}
