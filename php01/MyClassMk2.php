<?php

namespace Php01;

/**
 * Simple extended class.
 *
 * PHP Version 7.2
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
