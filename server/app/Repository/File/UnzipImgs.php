<?php

namespace App\Repository\File;

/**
 * ZipArchiveのラッパークラス
 * 画像形式のファイルか判断し、ナンバリングする。
 */
class UnzipImgs
{

  public $path = null;
  public $imageNum = null;
  public $imageList = null;
  private $destroyMode = null;

  /**
   * @constructor
   *
   * @param string $zipPath 解凍したいzipファイルの相対パス
   * @param boolean $destroyMode 解凍後、trueならzipファイルを削除する(デバッグ用にfalseを使う)
   */
  public function __construct($zipPath, $destroyMode = false)
  {
    $this->path = $zipPath;
    $this->imageNum = 0;
    $this->destroyMode = $destroyMode;
  }

  /**
   * 解凍用メソッド
   *
   * @param string $newDirName 保存用ディレクトリの名前
   * @return mixed 正常に終了すればtrueが返ってくるが、それ以外はエラーメッセージが返る。
   */
  public function unzip($newDirName, $strictCheck = 0)
  {
    $tmpDir = uniqid();

    // 新規保存するディレクトリが存在するかチェックする
    if (!file_exists($newDirName)) {
      mkdir($newDirName);
    }

    // 一時保存ディレクトリが存在するかチェックする
    if (!file_exists($tmpDir)) {
      mkdir($tmpDir);
    }

    $zip = new \ZipArchive();
    $res = $zip->open($this->path);

    if ($res === true) {
      $zip->extractTo($tmpDir);
      $zip->close();
    } else {
      return "Error. Can't unzip.";
    }
    if ($this->destroyMode) {
      unlink($this->path);
    }

    // ファイルのパスを保存する
    if ($handle = opendir($tmpDir)) {
      while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
          $tmpFiles[] = $file;
        }
      }
      closedir($handle);
    }
    if (count($tmpFiles) === 0) {
      return "Error. No file exits.";
    }

    // 昇順でソート
    natcasesort($tmpFiles);
    $img_flag = 0;
    foreach ($tmpFiles as $file) {

      $target = $tmpDir . "/" . $file;
      // ディレクトリなら
      if (is_dir($target)) {
        $subFiles = scandir($target);

        //ファイル数をチェック
        $count = count($subFiles) - 2; //余計なドットを弾いている。

        foreach ($subFiles as $subFile) {
          if ($subFile == "." || $subFile == "..") {
            continue;
          }

          $originalName = $this->getOriginalName($subFile);
          $subFilePath = $target . "/" . $subFile;

          // 画像ファイルか適切かチェック
          if (!$ext = $this->isValidImage($subFilePath)) {
            if ($this->destroyMode) {
              //画像以外は削除してコンティニュー
              unlink($subFilePath);
              continue;
            } else {
              continue;
            }
          }
          $this->imageNum++;

          $newFileName = $originalName . "." . $ext;
          $this->imageList[] = $newFileName;
          // 移動
          rename($subFilePath, $newDirName . "/" . $newFileName);
          chmod($newDirName . "/" . $newFileName, 0644);

        }

      } else {
        //すぐにファイルなら、画像ファイルかどうかチェック
        $filePath = $target;

        $originalName = $this->getOriginalName($filePath);

        // 画像ファイルか適切かチェック
        if (!$ext = $this->isValidImage($filePath)) {
          if ($this->destroyMode) {
            //画像以外は削除してコンティニュー
            unlink($filePath);
            continue;
          } else {
            continue;
          }
        }

        $this->imageNum++;

        // $new_file_name = sprintf('%04d', $this->imageNum) . "." . $ext;
        $newFileName = $originalName . "." . $ext;
        $this->imageList[] = $newFileName;
        // 移動
        rename($filePath, $newDirName . "/" . $newFileName);
        chmod($newDirName . "/" . $newFileName, 0644);

      }

    }
    if (file_exists($tmpDir)) {
      $this->remove_directory($tmpDir);
    }
    return true;
  }

  /**
   * 妥当な画像か判断
   *
   * @param string $file 判断するファイルへの相対パス
   * @return boolean    画像と判断されれば拡張子が返される。それ以外ならfalseが返る
   */
  public function isValidImage($file)
  {
    $checkExt = [
      'gif' => 'image/gif',
      'jpg' => 'image/jpeg',
      'png' => 'image/png',
    ];

    if (!$mime = array_search(mime_content_type($file), $checkExt, true)) {
      return false;
    }

    $getExt = explode('.', $file);
    $ext = strtolower(end($getExt));

    if ($ext == 'jepg') {
      $ext = 'jpg';
    }

    if ($mime == $ext) {
      return $ext;
    } else {
      return false;
    }
  }

  private function getOriginalName($filePath)
  {
    return explode('.', basename($filePath))[0];
  }

  /**
   * 指定されたディレクトリとファイルを再帰的に削除する(PHP公式を参考)
   *　http://jp.php.net/rmdir
   * @param string $dir 削除したいディレクトリ
   * @return void
   */
  public function remove_directory($dir)
  {
    if ($handle = opendir("$dir")) {
      while (false !== ($item = readdir($handle))) {
        if ($item != "." && $item != "..") {
          if (is_dir("$dir/$item")) {
            $this->remove_directory("$dir/$item");
          } else {
            unlink("$dir/$item");
          }
        }
      }
      closedir($handle);
      rmdir($dir);
    }
  }
}


