<?php


namespace App\Repository\DB;

use App\Queue;
use Exception;
use App\Domain\Entities;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\BookId;

class QueueRepository
{
    private $model;
    private $queue;

    public function first(): Entities\Queue
    {
        $model = Queue::first();
        if ($model == null) {
            throw new Exception("No Queue");
        }
        return new Entities\Queue(new UserId($model->user_id), new BookId($model->book_id));
    }

    public function find(BookId $bookId): Entities\Queue
    {
        $model= Queue::find($bookId->value());

        return new Entities\Queue(
            new UserId($model->user_id),
            new BookId($model->book_id)
        );
    }

    public function save(Entities\Queue $queue)
    {
        $model = new Queue;
        $model->user_id = $queue->getUserId();
        $model->book_id = $queue->getBookId();
        $model->save();
    }

    public function delete(BookId $bookId){
        $model= Queue::find($bookId->value());
        $model->delete();
    }
}
