<?php

namespace Php01;

/**
 * Simple base class.
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
    /**
     * Class(static) property
     *
     * @var string $staticProperty
     */
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
        echo '<br>'.'__construct($p1) called. $p1 is '.$p1.'<br>';
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
