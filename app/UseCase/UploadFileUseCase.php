<?php

namespace App\UseCase;


use Illuminate\Http\Request;

use Validator;
use Exception;

use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\BookId;
use App\Domain\ValueObject\ImgDir\OriginalZip;
use App\Domain\ValueObject\ImgDir\BookName;
use App\Domain\ValueObject\ImgDir\BookOptions;
use App\Domain\ValueObject\ImgDir\OpenType;
use App\Domain\ValueObject\ImgDir\Description;

use App\Domain\Entities\imgDir;
use App\Domain\Entities\Queue;

use App\Repository\DB\QueueRepository;
use App\Repository\DB\ImgDirRepository;
use App\Repository\DB\UserLevelRepository;

use App\Libs\Utils;
use App\Libs\ImageValidation;
use App\Repository\File\UnzipImgs;

class UploadFileUseCase
{
  private $imgDirRepository;
  private $queueRepository;
  private $userLevelRepository;

  public function execute(Request $request)
  {
    $imgDirRepository = new ImgDirRepository();
    $queueRepository = new QueueRepository();
    $userLevelRepository = new UserLevelRepository();

    // ユーザーの24時間以内のアップロード数をチェック
    $userLevel = $userLevelRepository->find(new UserId($request->user_id));
    if (!$userLevel->checkLimit()) {
      return ['error' => '24時間のサイズ制限を越えました。', 'remaining_time' => $userLevel->displayRemainingTime()];
    }

    // ファイルの妥当性チェック
    try {
      $this->validateImage($request);
    } catch (\Exception $e) {
      return ['error' => $e->getMessage()];
    }

    // 展開
    try {
      $bookId = $this->unzipFile($request);
    } catch (\Exception $e) {
      return ['error' => $e->getMessage()];
    }

    $bookIdDir = $bookId->dir();

    // 画像の妥当性チェック
    $image_validation = new ImageValidation($bookId);

    try {
      $image_validation->validate();
    } catch (\Exception $e) {
      // 失敗したら削除
      try {
        Utils::removeDirectory($bookIdDir);
      } catch (\Exception $e) {
        return ['error' => $e->getMessage()];
      }
      return ['error' => $e->getMessage()];
    }

    // フアイルサイズ
    $fileSize = $image_validation->getFileSize();

    $originalZip = new OriginalZip($request->file('upfile')->getClientOriginalName());
    $userId = new UserId($request->user_id);
    $bookName = new BookName("");//$request->bookName
    $description = new Description("");//$request->description
    $bookOptions = new BookOptions("");//$request->bookOptions
    $openType = new OpenType(0);//$request->openType

    $imgDir = new ImgDir($userId, $originalZip, $bookId, $bookName, $description, $bookOptions, $openType);
    $imgDirRepository->save($imgDir);
    $queueRepository->save(new Queue($userId, $bookId));

    $userLevel->addNewBook($fileSize);
    $userLevelRepository->save($userLevel);


    return ['success' => $originalZip->value()];
  }


  private function unzipFile(Request $request): BookId
  {
    $file = $request->file('upfile');

    $str = Utils::generateRamdomString(12);

    $newZipPath = $file->move(public_path('tmp/'), $str . '_temp.zip');

    $imgZip = new UnzipImgs($newZipPath, true);

    // ターゲットディレクトリの展開

    $bookId = Utils::generateRamdomString(16);
    $bookIdDir = public_path('tmp/' . $bookId);

    $result = $imgZip->unzip($bookIdDir);

    // エラーがあった場合、エラーメッセージを飛ばす
    if ($result != true) {
      throw new Exception($result);
    }
    return new BookId($bookId);
  }

  private function validateImage(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'upfile' => 'required|max:30720'
    ]);

    if ($validator->fails()) {
      $errors = $validator->errors();
      throw new Exception($errors);
    }
  }
}
