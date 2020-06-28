<?php


namespace App\Repository\DB;

use App\OcrText;

use App\Domain\Entities;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\BookId;
use App\Domain\ValueObject\ImgPath;
use App\Domain\ValueObject\TextData;

class OcrTextRepository
{
    private $model;
    private $queue;

    public function first(): Entities\OcrText
    {
        $model = Queue::first();
        if ($model == null) {
            throw new Exception("No OcrText");
        }
        return new Entities\OcrText(new UserId($model->user_id), new BookId($model->book_id));
    }

    public function find(BookId $book_id): Entities\OcrText
    {
        $model= OcrText::find($book_id->get());

        return new Entities\OcrText(
            new BookId($model->book_id),
            new UserId($model->user_id),
            new ImgPath($model->img_path),
            new TextData($model->text_data)
        );
    }

    public function save(Entities\OcrText $ocr_text)
    {
        $model = new OcrText;
        $model->user_id = $ocr_text->getUserId();
        $model->book_id = $ocr_text->getBookId();
        $model->img_path = $ocr_text->getImgPath();
        $model->text_data = $ocr_text->getTextData();
        $model->save();
    }

    public function saveAll(array $ocr_texts)
    {
        foreach ($ocr_texts as $ocr_text) {
            $this->save($ocr_text);
        }
    }

    public function updateTextData(Entities\OcrText $ocr_text)
    {
        $model = OcrText::find(new BookId($ocr_text->getBookId()));

        $model->text_data = $ocr_text->getTextData();
        $model->save();
    }
}
