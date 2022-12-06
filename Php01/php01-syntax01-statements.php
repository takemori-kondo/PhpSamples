<?php
// PHP Version 8.1
declare(strict_types=1);
namespace Php01;

/*
マルチバイトのベストプラクティス
1. ファイル名にマルチバイトを含めない
2. 可能な限りBOMなしUTF-8で統一する
3. 文字列操作には必ずmbを使用し、mbでない文字列操作の標準ライブラリやブラケット構文を使わない
    - mb_strlen
    - mb_strtolower
    - mb_strtoupper
    - mb_substr
    - mb_ereg_replace
    - mb_split
    - mb_strpos
    - mb_strrpos
    - mb_convert_kana
4. php.ini あるいは .user.ini
; Core
; default_charset ("UTF-8")
; zend.multibyte (0)
; zend.script_encoding (NULL)
;    ファイルエンコーディングがSJIS等でなければscript_encodingはデフォルトのISO-8859-1(Latin-1)で問題ない
;    ファイル中のリテラルはdefault_charset(internal_encoding)で処理されるため、問題ない
;    なお、ファイルエンコーディングをファイル個別に指定するdeclare(encoding=...)は、この機能を有効にしないと機能しない
; mbstring
mbstring.detect_order = UTF-8,EUC-JP,SJIS,JIS,ASCII
; mbstring.language ("neutral")
;    この値は、具体的にはmb_encode_mimeheader、mb_send_mailの2つに影響する
;    メールは今でもISO-2022-JP(=JIS)で送るべきだ、と思う人はJapaneseに設定する
; mbstring.encoding_translation (0)
mbstring.http_input = NULL
mbstring.http_output = NULL
; mbstring.http_output_conv_mimetypes ("^(text/|application/xhtml\+xml)")
; mbstring.internal_encoding (NULL)
; mbstring.regex_retry_limit (1000000)
; mbstring.regex_stack_limit (100000)
; mbstring.strict_detection (0)
; mbstring.substitute_character (NULL)
*/
echo '<h1>'.__FILE__.'</h1>'."\n";

echo '<h2>変数</h2>'."\n";
$selector = 'dic';
var_dump($selector);
echo "<br>\n";

echo '<h2>連想配列</h2>'."\n";
$dic = ['foo' => 'Alice', 'bar' => 'Bob', 'baz' => 'Carol'];
var_dump($dic);
echo "<br>\n";

echo '<h2>可変変数</h2>'."\n";
var_dump(${$selector});
echo "<br>\n";

echo '<h2>定数</h2>'."\n";
const CNST = '定数には$は付けない';
var_dump(CNST);
echo "<br>\n";

echo '<h2>文字列リテラル3種</h2>'."\n";
$val = '$valの中身';
$simple = 'シングルクォートは変数展開されない:{$val}';
$interpolation = "ダブルクォートは変数展開される:{$val}";
$here = <<<"HEREDOC"
これはヒアドキュメントです
お作法として、ヒアドキュメントIDは必ず"か'で囲んだほうが分かりやすいです。:{$val}
HEREDOC;
echo '<pre>'."\n";
echo $simple."\n";
echo $interpolation."\n";
echo $here."\n";
echo '</pre>'."\n";

echo '<h2>厳密な比較演算</h2>'."\n";
$strVar = '2';
$numVar = 2;
$result = $strVar === $numVar;
var_dump($strVar);
echo "<br>\n";
var_dump($numVar);
echo "<br>\n";
var_dump($result);
echo "<br>\n";

echo '<h2>制御文</h2>'."\n";
if (array_key_exists('baz', $dic)) {
    echo 'if statement is TRUE!'."<br>\n";
}
if (array_key_exists('qux', $dic)) {
} else {
    echo 'if statement is FALSE!'."<br>\n";
}
echo "<br>\n";

while (count($dic) < 5) {
    $x = 'This element was added when count() is '.((string)count($dic));
    array_push($dic, $x);
}
echo '<pre>'."\n";
var_dump($dic);
echo '</pre>'."\n";

foreach ($dic as $key => $val) {
    echo $key."'s value is ".$val."<br>\n";
}

echo '<h2>関数、配列、インスタンス</h2>'."\n";
echo '配列は値型ライク、配列とインスタンスの変換は生成される'."\n";
function echoCompare(mixed $arg1, mixed $arg2, string $text) : void {
    $isEqual = ($arg1 === $arg2);
    echo "<strong>{$text}</strong>"."<br>\n";
    var_dump($arg1);
    echo "<br>\n";
    var_dump($arg2);
    echo "<br>\n";
    var_dump($isEqual);
    echo "<br>\n";
}
$ary1 = ['key1' => 'val1', 'key2' => 'val2'];
$ary2 = $ary1;
$obj1 = (object)$ary1;
$obj2 = (object)$ary1;
$ary3 = (array)$obj1;
$obj3 = $obj1;
echo '<h3>最初の状態</h3>'."\n";
echoCompare($ary1, $ary2, '$ary1 === $ary2'); // true
echoCompare($ary1, $ary3, '$ary1 === $ary3'); // true …①
echoCompare($ary1, $obj1, '$ary1 === $obj1'); // false
echoCompare($obj1, $obj2, '$obj1 === $obj2'); // false
echoCompare($obj1, $obj3, '$obj1 === $obj3'); // true
echo '<h3>ary1, obj1 にkey3を追加</h3>'."\n";
$ary1['key3'] = 'val3';
$obj1->key3 = 'val3';
echoCompare($ary1, $ary2, '$ary1 === $ary2'); // false
echoCompare($ary1, $ary3, '$ary1 === $ary3'); // false …②
echoCompare($ary1, $obj1, '$ary1 === $obj1'); // false
echoCompare($obj1, $obj2, '$obj1 === $obj2'); // false
echoCompare($obj1, $obj3, '$obj1 === $obj3'); // true
echo '<h2>ary3に key3を追加</h2>'."\n";
$ary3['key3'] = 'val3';
echoCompare($ary1, $ary2, '$ary1 === $ary2'); // false
echoCompare($ary1, $ary3, '$ary1 === $ary3'); // true …③
echoCompare($ary1, $obj1, '$ary1 === $obj1'); // false
echoCompare($obj1, $obj2, '$obj1 === $obj2'); // false
echoCompare($obj1, $obj3, '$obj1 === $obj3'); // true