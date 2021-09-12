<?php
// PHP Version 8.1

namespace Php01;

ini_set('display_errors', 1);

echo '<h1>'.__FILE__.'</h1>'."\n";

require_once __DIR__.'/Classes/MyClass.php';
require_once __DIR__.'/Classes/MyClassMk2.php';

var_dump(MyClass::$staticProperty);
MyClass::staticMethod();
$a = new MyClass('Foo');
$a->instanceMethod();
$b = new MyClass('Bar');
$b->instanceMethod();
$c = new MyClassMk2('Baz');
$c->instanceMethod();

echo "<br>\n";
var_dump($a);
echo "<br>\n";
var_dump($b);
echo "<br>\n";
var_dump($c);
echo "<br>\n";

/*
PHP Specific Features

PHPのオブジェクト指向とstaticの関係は他の言語と異なる。
フィールドはstatic・インスタンスに分かれ他の言語と同様であるが、メソッドはインスタンス・staticメソッドには分かれない。
<Class名>::、self::、static::、parent::いずれもいわゆる他の言語で言うところのインスタンスメソッドがコール可能である。
オブジェクトメソッドか、staticに呼ばれるかは、呼び出し元の文脈で決まり、$thisも文脈に従う。

同一名前空間のClassを使用する場合、クラス名に\は付けなくてもよい
異なる名前空間のClassを使用する場合、クラス名に¥をつけることが推奨される

use        require_onceはファイル読み込み、useは名前空間の解決(他の用途でtraitの利用)
self::     記述位置のクラスのメソッドを呼ぶ
static::   メソッドの場合は、呼び出し元の文脈に従う
parent::   記述クラスの親クラスのメソッドを呼ぶ
::class    クラスの完全名を文字列で取得
overload   PHPのオーバーロードは、未宣言プロパティへの動的確保set/get機能
__get      マジックメソッド。overloadの挙動を決める。未定義時は未宣言プロパティへset済みなら取得できる
__set      マジックメソッド。overloadの挙動を決める。未定義時は未宣言プロパティへsetできる
__invoke   マジックメソッド。インスタンス自体を()することで呼び出される関数
trait      Mix-in
Anonymous  無名クラス
foreach    インスタンスに対してforeach可能
==         同じ型であり、全てのプロパティが==比較でTrueかを調べる
*/
