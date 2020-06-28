<?php

namespace App\Repository\Api;

use App\Domain\Entities\OcrText;
use Exception;
use App\Domain\ValueObject\BookId;
use App\Domain\ValueObject\UserId;
use App\Domain\ValueObject\OcrText\ImgPath;
use App\Domain\ValueObject\OcrText\TextData;

class CloudVision
{
  private $API_KEY;
  private $MAX_IMG_NUM;
  private $fulltext = array();
  private $bookId;
  private $userId;

  public function __construct()
  {
    $this->API_KEY = env('API_KEY');
    $this->MAX_IMG_NUM = env('MAX_IMG_NUM', 15);
  }

  public function read(UserId $userId, BookId $bookId): array
  {
    $this->userId = $userId;
    $this->bookId = $bookId;
    $bookIdDir = $bookId->dir();
    $imagePaths = $this->getImagePath($bookIdDir);

    $data = array();
    $requests = array();
    foreach ($imagePaths as $imagePath) {
      $requests[] = $this->convertImage2FormatData($imagePath);
      $tmpImagePaths[] = $imagePath;
      if (count($requests) >= $this->MAX_IMG_NUM) {
        try {
          $this->request2API($requests, $tmpImagePaths);
        } catch (\Exception $e) {
          throw new Exception($e);
        }
        sleep(1);
        $requests = array(); // 初期化
        $tmpImagePaths = array(); // 初期化
      }
    }

    // 残ったデータをリクエスト
    if (count($requests) > 0) {
      try {
        $this->request2API($requests, $tmpImagePaths);
      } catch (\Exception $e) {
        throw new Exception($e);
      }
    }
    return $this->fulltext;
  }


  /**
   * APIへリクエストを送る
   *
   * @param array $requests 主にBase64エンコードされたデータを格納した配列
   * @param array $tmpImagePaths 画像のパス(現在は使われていないが、将来使う可能性がある)
   * @return mixed 成功の際はtrueを、失敗であればエラー理由を返す
   */
  protected function request2API($requests, $tmpImagePaths)
  {
    $body = [];

    $body = [
      'requests' => $requests
    ];


    // リクエスト用のJSONを作成
    $json = json_encode($body);

    // リクエストを実行
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://vision.googleapis.com/v1/images:annotate?key=" . $this->API_KEY);
    curl_setopt($curl, CURLOPT_HEADER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 15);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $json);
    $res1 = curl_exec($curl);
    $res2 = curl_getinfo($curl);


    //エラーがあった場合には失敗とする
    if (curl_errno($curl)) {
      throw new Exception(curl_errno($curl));
    }

    curl_close($curl);

    // 取得したデータ
    $json = substr($res1, $res2["header_size"]);

    $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
    $arr = json_decode($json, true);

    if (!isset($arr['responses'])) {
      throw new Exception("APIエラー。データに問題があります");
    }


    // 配列の数
    $jsonCount = count($arr['responses']);

    $text = array();

    // 出力
    for ($i = 0; $i <= $jsonCount - 1; $i++) {
      if (isset($arr['responses'][$i]['textAnnotations'][0]['description'])) {
        $ocr_text = new OcrText(
          $this->bookId,
          $this->userId,
          new ImgPath(basename($tmpImagePaths[$i])),
          new TextData($arr['responses'][$i]['textAnnotations'][0]['description'])
        );

        $this->fulltext[] = $ocr_text;
      }
    }
  }

  private function convertImage2FormatData($image_path)
  {
    $image = base64_encode(file_get_contents($image_path));
    return array(
      'image' => ['content' => $image],
      'features' => [
        ['type' => 'TEXT_DETECTION'],
      ]
    );
  }

  private function getImagePath($bookIdDir)
  {
    $imagePaths = array();

    // ファイルのパスを保存する
    if ($handle = opendir($bookIdDir)) {
      while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
          $imagePaths[] = $bookIdDir . '/' . $file;
        }
      }
      closedir($handle);
    }
    return $imagePaths;
  }
}
