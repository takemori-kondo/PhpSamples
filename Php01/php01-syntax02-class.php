<?php
// PHP Version 8.1
declare(strict_types=1);
namespace Php01;

/*
PHP Specific Features

①
PHPのオブジェクト指向とstaticの関係は他の言語と異なる。
フィールドはstatic・インスタンスに分かれ他の言語と同様であるが、メソッドはインスタンス・staticメソッドには分かれない。
<Class名>::、self::、static::、parent::いずれもいわゆる他の言語で言うところのインスタンスメソッドがコール可能である。
オブジェクトメソッドか、staticに呼ばれるかは、呼び出し元の文脈で決まり、$thisも文脈に従う。

②
ErrorExceptionなどの標準クラスは直接¥を書く形式（¥ErrorException）がわかりやすい

③
use              require_onceはファイル読み込み、useは名前空間の解決(他の用途でtraitの利用)
self::           記述位置のクラスのメソッドを呼ぶ
static::         メソッドの場合は、呼び出し元の文脈に従う
parent::         記述クラスの親クラスのメソッドを呼ぶ
::class          クラスの完全名を文字列で取得
overload         PHPのオーバーロードは、未宣言プロパティへの動的確保set/get機能
__get            マジックメソッド。overloadの挙動を決める。未定義時は未宣言プロパティへset済みなら取得できる
__set            マジックメソッド。overloadの挙動を決める。未定義時は未宣言プロパティへsetできる
__invoke         マジックメソッド。インスタンス自体を()することで呼び出される関数
trait            Mix-in
Anonymous class  無名クラス
foreach          インスタンスに対してforeach可能
==               同じ型であり、全てのプロパティが==比較でTrueかを調べる
===              参照一致かどうか
*/
require_once 'myautoload.php';

use Php01\Classes\MyClass;
use Php01\Classes\MyClass2;

echo '<h1>'.__FILE__.'</h1>'."\n";

function callInstanceMethod(MyClass $obj) : void {
    $obj->instanceMethod();
}

var_dump(MyClass::$staticProperty);
echo "<br>\n";
MyClass::staticMethod();
echo "<br>\n";

$a = new MyClass('Foo');
callInstanceMethod($a);
$b = new MyClass('Bar');
callInstanceMethod($b);
$c = new MyClass2('Baz');
callInstanceMethod($c);
echo "<br>\n";

var_dump($a);
echo "<br>\n";
var_dump($b);
echo "<br>\n";
var_dump($c);
echo "<br>\n";