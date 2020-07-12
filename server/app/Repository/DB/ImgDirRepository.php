<?php

namespace App\Repository\DB;

use App\Domain\ValueObject\ImgDir\BookName;
use App\Domain\ValueObject\ImgDir\BookOptions;
use App\Domain\ValueObject\ImgDir\Description;

use App\Domain\ValueObject\ImgDir\FileSize;
use App\ImageDir;

use App\Domain\Entities;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\BookId;
use App\Domain\ValueObject\ImgDir\OriginalZip;

use App\OcrText;
use Exception;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class ImgDirRepository
{
    /**
     * @var ImageDir
     */
    private $imgDir;

    public function __construct()
    {
        $this->imgDir = new ImageDir();
    }

    public function find(BookId $tmpBookId)
    {
        $model = ImageDir::find($tmpBookId->value());
        $userId = new UserId($model->user_id);
        $originalZip = new OriginalZip($model->original_zip);
        $filSize = new FileSize($model->file_size);
        $bookId = new BookId($model->book_id);
        $bookName = new BookName($model->bookName ?? "");
        $description = new Description($model->description ?? "");
        $bookOptions = new BookOptions($model->bookOptions ?? "");

        return new Entities\ImgDir($userId, $originalZip, $filSize, $bookId, $bookName, $description, $bookOptions);
    }

    public function save(Entities\ImgDir $imgDir)
    {
        $model = new ImageDir();
        $model->user_id = $imgDir->getUserId();
        $model->original_zip = $imgDir->getOriginalZip();
        $model->file_size = $imgDir->getFileSize();
        $model->book_id = $imgDir->getBookId();
        $model->book_name = $imgDir->getBookName();
        $model->description = $imgDir->getDescription();
        $model->book_options = $imgDir->getBookOptions();
        $model->state = $imgDir->getState();
        $model->save();
    }

    public function updateState(Entities\ImgDir $img_dir)
    {
        $model = ImageDir::find($img_dir->getBookId());
        if (!$model) throw \Illuminate\Validation\ValidationException::withMessages(["message" => "no updatedState"]);
        $model->state = 1;
        $model->save();
    }

    public function listBooks(UserId $userId, $page = 1)
    {
        $page = ($page * 5);
        $imageDirs = ImageDir::where('user_id', $userId->value())->orderBy('created_at', 'desc')->paginate($page);
        return $imageDirs;
    }

    public function listBooksByState(int $state = 0)
    {
        return ImageDir::where("state", $state)->get();
    }

    public function fetchBook(BookId $bookId)
    {
        $imageDirs = ImageDir::find($bookId->value());
        $ocrTexts = OcrText::where('book_id', $bookId->value())->orderBy('img_path')->get();
        if ($ocrTexts === null) {
            throw new Exception("ディリクトリがありません");
        }

        return compact('ocrTexts', 'imageDirs');
    }

    public function deleteByBookIds(array $bookIds)
    {
        ImageDir::whereIn("book_id", $bookIds)->delete();
    }
}
