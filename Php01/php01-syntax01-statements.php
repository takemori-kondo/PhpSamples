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
; 
: mbstring
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

echo '<h1>' . __FILE__ . '</h1>' . "\n";

echo '<h2>1. 変数、配列、可変変数、定数</h2>' . "\n";
$var = 'dic';
$dic = ['foo' => 'Alice', 'bar' => 'Bob', 'baz' => 'Carol'];
const CNST = '定数には$は付けない';
echo "<pre>\n";
var_dump($var);
var_dump($dic);
var_dump(${$var});
var_dump(CNST);
echo "</pre>\n";

echo '<h2>2. 文字列リテラル3種</h2>' . "\n";
$val = '変数の中身';
$single = '\'は変数展開しない:{$val}';
$double = "\"は変数展開される:{$val}";
$heredoc = <<<"HEREDOC"
これはヒアドキュメントです
お作法として、ヒアドキュメントIDは必ず'か"で囲んだほうが分かりやすいです。:{$val}
HEREDOC;
echo "<pre>\n";
echo $single . "\n";
echo $double . "\n";
echo $heredoc . "\n";
echo "</pre>\n";

echo '<h2>3. 厳密な比較演算</h2>' . "\n";
$strVar = '2';
$numVar = 2;
echo "<pre>\n";
var_dump($strVar);
var_dump($numVar);
var_dump($strVar == $numVar);
var_dump($strVar === $numVar);
echo "</pre>\n";

echo '<h2>4. 制御文</h2>' . "\n";
$cnt = 0;
echo "<pre>\n";
if (true) {
    echo 'ifブロックに来ました。' . "\n";
} else {
    echo 'ここは通りません。' . "\n";
}
if (false) {
    echo 'ここは通りません。' . "\n";
} else {
    echo 'elseブロックに来ました。' . "\n";
}
while ($cnt < 5) {
    echo 'count up!' . "\n";
    $cnt++;
}
foreach ($dic as $key => $val) {
    echo "key=$key, val=$val" . "\n";
}
echo "</pre>\n";

echo '<h2>5. 関数、配列、インスタンス</h2>' . "\n";
function echoAndCompare(mixed $arg1, mixed $arg2, string $text): void
{
    echo "$text : ";
    var_dump($arg1 === $arg2);
}
echo "<pre>\n";
echo '配列は各要素で比較される（初期状態と最終状態の$ary1 === $ary3 が true）' . "\n";
echo '配列からオブジェクトへのキャストは生成される（$obj1 === $obj2 が false）' . "\n";
echo '最初の状態' . "\n";
$ary1 = ['key1' => 'val1', 'key2' => 'val2'];
$ary2 = $ary1;
$obj1 = (object)$ary1;
$obj2 = (object)$ary1;
$ary3 = (array)$obj1;
$obj3 = $obj1;
echoAndCompare($ary1, $ary2, '$ary1 === $ary2'); // true
echoAndCompare($ary1, $ary3, '$ary1 === $ary3'); // true
echoAndCompare($ary1, $obj1, '$ary1 === $obj1'); // false
echoAndCompare($obj1, $obj2, '$obj1 === $obj2'); // false
echoAndCompare($obj1, $obj3, '$obj1 === $obj3'); // true
echo 'ary1, obj1 にkey3を追加' . "\n";
$ary1['key3'] = 'val3';
$obj1->key3 = 'val3';
echoAndCompare($ary1, $ary2, '$ary1 === $ary2'); // false
echoAndCompare($ary1, $ary3, '$ary1 === $ary3'); // false
echoAndCompare($ary1, $obj1, '$ary1 === $obj1'); // false
echoAndCompare($obj1, $obj2, '$obj1 === $obj2'); // false
echoAndCompare($obj1, $obj3, '$obj1 === $obj3'); // true
echo 'ary3 にkey3を追加' . "\n";
$ary3['key3'] = 'val3';
echoAndCompare($ary1, $ary2, '$ary1 === $ary2'); // false
echoAndCompare($ary1, $ary3, '$ary1 === $ary3'); // true
echoAndCompare($ary1, $obj1, '$ary1 === $obj1'); // false
echoAndCompare($obj1, $obj2, '$obj1 === $obj2'); // false
echoAndCompare($obj1, $obj3, '$obj1 === $obj3'); // true
echo "</pre>\n";

echo '<h2>6. 主な配列操作</h2>' . "\n";
echo "<pre>\n";
echo  var_dump($dic);
echo 'in_array("Alice", $dic)       : ' . in_array("Alice", $dic, true) . "\n";
echo 'array_key_exists("baz", $dic) : ' . array_key_exists("baz", $dic) . "\n";
echo 'count($dic)                   : ' . count($dic) . "\n";
echo "</pre>\n";
