<?php


namespace App\Repository\DB;

use App\Queue;
use Exception;
use App\Domain\Entities;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\BookId;
use Illuminate\Support\Facades\DB;

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
        return new Entities\Queue(new UserId($model->user_id), new BookId($model->book_id), $model->updated_at);
    }

    public function find(BookId $bookId): Entities\Queue
    {
        $model = Queue::find($bookId->value());

        return new Entities\Queue(
            new UserId($model->user_id),
            new BookId($model->book_id),
            $model->updated_at
        );
    }

    public function getExecQueue()
    {

        $execQueue = DB::table('queues')->where('is_ocring', true)->get();
        if (count($execQueue) == 0) return null;

        $queues = [];
        foreach ($execQueue as $tmpQueue) {
            $queue = new Entities\Queue(
                new UserId($tmpQueue->user_id),
                new BookId($tmpQueue->book_id),
                $tmpQueue->updated_at
            );
            array_push($queues, $queue);
        }

        return $queues;


    }

    public function getUnOcredQueue()
    {
        $tmpQueue = DB::table('queues')->where('is_ocring', false)->get();
        if (!count($tmpQueue)) return null;

        $this->queue = new Entities\Queue(
            new UserId($tmpQueue[0]->user_id),
            new BookId($tmpQueue[0]->book_id),
            $tmpQueue[0]->updated_at
        );
        return $this->queue;
    }

    public function save(Entities\Queue $queue)
    {
        $model = Queue::find($queue->getBookId());
        if (!$model) {
            $model = new Queue;
            $model->book_id = $queue->getBookId();
        }
        $model->user_id = $queue->getUserId();
        $model->is_ocring = $queue->getIsOcring();
        $model->save();
    }

    public function delete(BookId $bookId)
    {
        $model = Queue::find($bookId->value());
        $model->delete();
    }

    public function remove(Entities\Queue $queue)
    {
        $model = Queue::find($queue->getBookId());
        $model->delete();
    }
}
