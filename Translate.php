<?php
require_once('defines.php');

/**
 * Created by PhpStorm.
 * User: joseph
 * Date: 15-8-17
 * Time: 下午8:31
 */
Class Translate
{
    static $words = null;

    function __construct()
    {
        if (empty(Translate::$words)) {
            Translate::$words = array();
            $this->initFromDict(ROOT_DIR);
        }
    }

    /**
     * 初始化所有单词
     * @param $rootDir 词典文件根路径
     */
    protected function initFromDict($rootDir)
    {
        if (is_dir($rootDir)) {
            $sourceName = '';

            //遍历所有文件
            if ($dh = opendir($rootDir)) {
                $fileIdx = '';
                $fileIfo = '';
                $fileDict = '';
                while (false !== ($file = readdir($dh))) {
                    // Skip '.' and '..'
                    if ($file == '.' || $file == '..')
                        continue;
                    $path = $rootDir . '/' . $file;
                    if (is_dir($path)) {
                        $this->initFromDict($path);
                    } else {
                        switch (strstr($file, ".")) {
                            case '.idx':
                                $fileIdx = $path;
                                break;
                            case '.ifo':
                                $fileIfo = $path;
                                break;
                            default:
                                $fileDict = $path;
                                $sourceName = strstr($file, ".", true);
                                break;
                        }
                    }
                }
                closedir($dh);
                if (!empty($fileIfo)) {

                    //打开字典文件,获取句柄
                    $fdict = fopen($fileDict, 'r');

                    //读取字典信息文件
                    $information = file_get_contents($fileIfo);

                    //获取字典内单词总数
                    if (preg_match("/.*wordcount=(\d*)/", $information, $match)) {
                        $iCount = $match[1];

                        //将所有文件内的全部单词缓存入数组
                        $fIdx = fopen($fileIdx, 'rb');
                        for ($i = 0; $i <= $iCount; $i++) {
                            $word = '';
                            //单词是以\0结尾的字符串
                            while ($ch = fgetc($fIdx)) {
                                if ($ch == "\0") {
                                    break;
                                }
                                if (empty($word) && $ch == '-') {
                                    continue;
                                } else {
                                    $word .= $ch;
                                }
                            }
                            //32位无符号整数的偏移值+32位无符号整数的size值
                            $data = unpack("N1offset/N1size", fread($fIdx, 8));

                            //将偏移,size,文件句柄缓存
                            Translate::$words[$word][$sourceName] = array(
                                'offset' => $data['offset'],
                                'size' => $data['size'],
                                'source' => $fdict
                            );
                        }
                        fclose($fIdx);
                    }
                }
            }
        }

    }

    /**
     * 翻译单词
     * @param $word 要翻译的单词
     * @return string 翻译的结果
     */
    public function translate($word)
    {
        $word = trim($word);
        $result = '';
        if (isset(Translate::$words[$word])) {
            foreach (Translate::$words[$word] as $tran) {
                fseek($tran['source'],$tran['offset']);
                $result .= "\n";
                $result .= fread($tran['source'],$tran['size']);
            }
        }
        return $result;
    }


}