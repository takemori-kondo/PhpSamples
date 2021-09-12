<?php
// PHP Version 8.1

namespace Php01;

ini_set('display_errors', 1);

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
$here = <<<EOD
これはヒアドキュメントです
シングルクォートで囲まないEODは変数展開されます。
:{$val}
EOD;
echo '<pre>'."\n";
echo $simple."\n";
echo $interpolation."\n";
echo $here."\n";
echo '</pre>'."\n";

echo '<h2>厳格な比較演算</h2>'."\n";
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
if (in_array('Bob', $dic)) {
    echo 'if statement is TRUE! "value=Bob" found.'."<br>\n";
}
if (array_key_exists('qux', $dic)) {
} else {
    echo 'if statement is FALSE! "key=qux" not found.'."<br>\n";
}
echo "<br>\n";

while (count($dic) < 5) {
    $x = 'xxx';
    array_push($dic, $x);
    echo 'Add '.$x.' by while.'."<br>\n";
}
var_dump($dic);
echo "<br>\n"."<br>\n";

echo 'foreach $dic'."<br>\n";
foreach ($dic as $key => $val) {
    echo $key.' is '.$val."<br>\n";
}

echo '<h2>関数、配列、インスタンス</h2>'."\n";
echo '配列は値型ライク、配列とインスタンスの変換は生成される'."\n";
function echoCompare(mixed $arg1, mixed $arg2, string $text) {
    $isEqual = ($arg1 === $arg2);
    echo '<strong>{$text}</strong>'."<br>\n";
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
echoCompare($ary1, $ary2, '$ary1, $ary2'); // true
echoCompare($ary1, $ary3, '$ary1, $ary3'); // true …①
echoCompare($ary1, $obj1, '$ary1, $obj1'); // false
echoCompare($obj1, $obj2, '$obj1, $obj2'); // false
echoCompare($obj1, $obj3, '$obj1, $obj3'); // true
echo '<h3>ary1, obj1 にkey3を追加</h3>'."\n";
$ary1['key3'] = 'val3';
$obj1->key3 = 'val3';
echoCompare($ary1, $ary2, '$ary1, $ary2'); // false
echoCompare($ary1, $ary3, '$ary1, $ary3'); // false …②
echoCompare($ary1, $obj1, '$ary1, $obj1'); // false
echoCompare($obj1, $obj2, '$obj1, $obj2'); // false
echoCompare($obj1, $obj3, '$obj1, $obj3'); // true
echo '<h2>ary3に key3を追加</h2>'."\n";
$ary3['key3'] = 'val3';
echoCompare($ary1, $ary2, '$ary1, $ary2'); // false
echoCompare($ary1, $ary3, '$ary1, $ary3'); // true …③
echoCompare($ary1, $obj1, '$ary1, $obj1'); // false
echoCompare($obj1, $obj2, '$obj1, $obj2'); // false
echoCompare($obj1, $obj3, '$obj1, $obj3'); // true