<?php

namespace App\UseCase;

use App\Domain\ValueObject\BookId;

use App\Libs\Utils;
use App\Repository\DB\ImgDirRepository;

final class DeleteExpiredIDirUseCase
{
    private $MAX_IMAGE_DIR_AVAILABLE_IN_SECONDS = 7 * (24 * 60 * 60);

    public function execute()
    {
        $imgDirRepository = new ImgDirRepository();
        $unexecutedImgDir = $imgDirRepository->listBooksByState();

        $tmpPath = public_path('tmp/');
        $removedDir = [];
        if ($handle = opendir($tmpPath)) {
            while (false !== ($item = readdir($handle))) {

                if ($item == "." || $item == "..") {
                    continue;
                }
                $passFlag = false;
                foreach ($unexecutedImgDir as $imgDir) {
                    if ($imgDir->book_id == $item) $passFlag = true;
                }
                if ($passFlag) continue;

                $bookId = new BookId($item);
                $targetPath = $bookId->dir();

                $now = time();
                if ($this->MAX_IMAGE_DIR_AVAILABLE_IN_SECONDS < $now - filemtime($targetPath)) {
                    array_push($removedDir, $targetPath);
                    Utils::removeDirectory($targetPath);
                }
            }
        }
        return $removedDir;
    }
}
