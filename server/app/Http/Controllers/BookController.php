<?php


namespace App\Http\Controllers;

use App\ImageDir;
use Illuminate\Http\Request;
use App\Domain\ValueObject\BookId;
use App\Domain\ValueObject\UserId;

use App\UseCase\Book\BookDeleteUseCase;
use App\UseCase\Book\BookFetchUseCase;
use App\UseCase\Book\BookListUseCase;


class BookController extends Controller
{
    function list(string $userId)
    {
        $perPage = 5;
        $imageDirs = ImageDir::where('user_id', $userId)->orderBy('created_at', 'desc')->paginate($perPage);
        return $imageDirs;
//        $usecase = new BookListUseCase();
//        return $usecase->execute(new UserId($userId));
    }

    function read(string $id)
    {
        $bookId = new BookId($id);
        $usecase = new BookFetchUseCase();
        return $usecase->execute($bookId);
    }

    function delete(Request $request)
    {
        $values = $request->input('bookIds');
        $bookIds = json_decode($values, true);

        $usecase = new BookDeleteUseCase();
        return $usecase->execute($bookIds);
    }
}
