<?php


namespace App\Libs;
use Exception;
class Utils
{
    /**
     * 文字列をランダムに生成(Laravel6からstr_randomが標準でなくなったので)
     *
     * @param [intger] $length
     * @return string
     */
    public static function generateRamdomString($length)
    {
        // 文字列の生成に使用する文字を変数へ代入(英数字)
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ0123456789';

        $str = '';

        // 繰り返し処理でランダムに文字列を生成
        for ($i = 0; $i < $length; $i++) {
            $str .= $chars[mt_rand(0, 61)];
        }

        return $str;
    }

    /**
     * 指定されたディレクトリとファイルを再帰的に削除する(PHP公式を参考)
     *　http://jp.php.net/rmdir
     * @param string $dir    削除したいディレクトリ
     * @return void
     */
    public static function removeDirectory($dir)
    {
        if ($handle = opendir($dir)) {
            while (false !== ($item = readdir($handle))) {
                if ($item != "." && $item != "..") {
                    if (is_dir("$dir/$item")) {
                        remove_directory("$dir/$item");
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