<?php

namespace App\Repository\DB;

use App\BatchErrorLog;
use Exception;

class ErrorLogRepository
{
    public static function save($errorMessage, $userId, $bookId)
    {
        $error_log = new BatchErrorLog;
        $error_log->error_message = $errorMessage;
        $error_log->user_id = $userId;
        $error_log->book_id = $bookId;
        $error_log->save();
    }
}
