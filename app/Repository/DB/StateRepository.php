<?php


namespace App\Repository\DB;
use Exception;

use App\State;

use App\Domain\Entities;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\BookId;

class StateRepository
{
    public function first(): Entities\State
    {
        $model = State::first();
        if ($model == null) {
            throw new Exception("No State");
        }
        return new Entities\State(
            new UserId((int)$model->user_id),
            new BookId($model->book_id),
            $model->created_at
        );
    }
    public function save(Entities\State $state)
    {
        $model = new State();
        $model->book_id = $state->getBookId();
        $model->save();
    }
    public function delete(){
        $model = State::first();
        $model->delete();
    }
}
