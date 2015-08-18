<?php
/**
 * Created by PhpStorm.
 * User: joseph
 * Date: 15-8-17
 * Time: 下午8:55
 */
require_once 'Translate.php';
$tran = new Translate();
while (1) {
    echo("\n请输入要翻译的英文单词(输入<exit>退出):\t");
    $word = fgets(STDIN);
    $word = str_replace(array("\r", "\n"), "", $word);
    if ($word == '<exit>') {
        break;
    } elseif (!empty($word)) {
        echo("\n--- {$word} ----\n");
        $result = $tran->translate($word);
        echo($result . "\n\n");
    }
}