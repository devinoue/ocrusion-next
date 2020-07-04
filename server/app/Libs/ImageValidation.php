<?php

namespace App\Libs;

use Exception;

use App\Domain\ValueObject\BookId;

/**
 * 指定されたディレクトリ以下の画像が適切かどうかをチェック
 * 不適切な理由を返す
 */
class ImageValidation
{
  private $bookIdDir;
  private $MAX_IMG_NUM;
  private $fileSize;

  public function __construct(BookId $bookId)
  {
    $this->bookIdDir = $bookId->dir();
    $this->MAX_IMG_NUM = env('MAX_IMG_NUM', 15);
  }

  public function getFileSize(): int
  {
    return $this->fileSize;
  }

  public function validate()
  {
    $imgaePaths = array();

    try {
      if ($handle = opendir($this->bookIdDir)) {
        while (false !== ($file = readdir($handle))) {
          if ($file != "." && $file != "..") {
            $imgaePaths[] = $this->bookIdDir . '/' . $file;
          }
        }
        closedir($handle);
      }
    } catch (\Exception $e) {
      throw new Exception("ディレクトリが存在しない可能性があります:" . $this->bookIdDir);
    }

    foreach ($imgaePaths as $imgaePath) {
      if (!file_exists($imgaePath)) {
        throw new Exception("file not found. path:" . $imgaePath);
      }
      $image = base64_encode(file_get_contents($imgaePath));

      if ((strlen($image) / 1000) >= 4000) {
        throw new Exception("1画像当たりのファイルサイズが大きすぎます");
      }

      $requests[] = array(
        'image' => ['content' => $image],
        'features' => [
          ['type' => 'TEXT_DETECTION'],
        ]
      );
      $tmpImagePaths[] = $imgaePath;

      // もしもリクエストするデータがmax_img_num(画像枚数)になったら
      if (count($requests) >= $this->MAX_IMG_NUM) {
        $chunkFileSize = strlen(json_encode($requests));
        if (($chunkFileSize / 1000) >= 8000) {
          throw new Exception("画像のファイルサイズが大きすぎます。もう少し小さくしてアップロードしてください:" . $chunkFileSize);
        }
        $this->fileSize += $chunkFileSize;
        $requests = array(); // 初期化
        $tmpImagePaths = array(); // 初期化
      }
    }
    // 残ったデータ
    if (count($requests) > 0) {
      $chunkFileSize = strlen(json_encode($requests));
      $this->fileSize += $chunkFileSize;
    }
  }
}
