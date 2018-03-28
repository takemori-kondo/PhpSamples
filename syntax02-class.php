<?php
/**
 * Class sample.
 *
 * PHP Version 7.2
 *
 * @category Foo
 * @package  None
 * @author   takemori <foo@bar.baz>
 * @license  https://bar.baz/ MIT License
 * @link     None
 */

/**
 * Simple Class.
 *
 * PHP Version 7.2
 *
 * @category Foo
 * @package  None
 * @author   takemori <foo@bar.baz>
 * @license  https://bar.baz/ MIT License
 * @link     None
 */
class MyClass
{
    // Class(static) property
    public static $staticProperty = "staticProperty's value";

    /**
     * Class(static) method
     *
     * @return void
     */
    public static function staticMethod()
    {
        echo 'staticMethod() called'.'<br>';
    }

    /**
     * Constructor (= new)
     * 
     * @param string $p1 This sets to $instanceProperty
     */
    public function __construct($p1)
    {
        echo '<br>'.'__construct() called. $p1 is '.$p1.'<br>';
        $this->instanceProperty = $p1;
    }

    // Instance property
    protected $instanceProperty;

    /**
     *  Instance method
     *
     * @return void
     */
    public function instanceMethod()
    {
        echo 'instanceMethod() called.'.'<br>';
        echo '"instanseProperty"='.$this->instanceProperty.'<br>';
    }
}

/**
 * Simple Class Mk2.
 *
 * PHP Version 7.2
 * This class extends MyClass.
 *
 * @category Foo
 * @package  None
 * @author   takemori <foo@bar.baz>
 * @license  https://bar.baz/ MIT License
 * @link     None
 */
class MyClassMk2 extends MyClass
{
    /**
     *  Instance method
     *
     * @return void
     */
    public function instanceMethod()
    {
        echo 'Overrided method!'.'<br>';
        echo '"instanseProperty"='.$this->instanceProperty.'<br>';
    }
}

var_dump(MyClass::$staticProperty);
MyClass::staticMethod();
$a = new MyClass('Foo');
$a->instanceMethod();
$b = new MyClass('Bar');
$b->instanceMethod();
$c = new MyClassMk2('Baz');
$c->instanceMethod();

/*
PHP Specific Features

use        require_onceはファイル読み込み、useは名前空間の解決(他の用途でtraitの利用)
self::     静的オーバーライド時、記述位置のクラスのメソッドを呼ぶ
static::   静的オーバーライド時、overrideされたメソッドを呼ぶ(他の用途でstaticメンバの宣言)
parent::   このキーワードは、インスタンスとstaticのどちらでも使える
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

/*
require_once __DIR__ . 'path.php';

namespace App\Controller;
use App\Controller\AppController;

class FoosController extends AppController
{
    use BarTrait;
    function Baz()
    {
    }
}
*/