<?php


namespace App\Repository\DB;


use App\Domain\ValueObject\UserLevel\Bonus;
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
            $times = new Times(array());
            $level = new Level(1);
            $bonus = new Bonus(0);
            $userLevel = new Entities\UserLevel($userId, $times, $level, $bonus);
            return $userLevel;
        }
        $times = new Times(Times::splitTimes($model->times));
        $level = new Level($model->level);
        $bonus = new Bonus($model->bonus);
        $userLevel = new Entities\UserLevel($userId, $times, $level, $bonus);
        return $userLevel;
    }

    public function save(Entities\UserLevel $userLevel)
    {
        $model = UserLevel::find($userLevel->getUserId());
        if (!$model) {
            throw new \Exception("Can't get user id");
        }
        $joinedTimes = $userLevel->getJoinedTimes();//これgetTimesは修正済みなのでこれも修正する必要がある
//        throw \Illuminate\Validation\ValidationException::withMessages(["filed" => $joinedTimes]);
        $model->times = $joinedTimes;
        $model->bonus = $userLevel->getBonus();
        $model->save();
    }
}
