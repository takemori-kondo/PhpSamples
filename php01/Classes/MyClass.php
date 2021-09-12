<?php
// PHP Version 8.1

namespace Php01\Classes;

class MyClass
{
    public static $staticProperty = "staticProperty's value";

    public static function staticMethod()
    {
        echo 'staticMethod() called'."<br>\n";
    }

    public function __construct($p1)
    {
        echo '__construct($p1) called. $p1 is '.$p1."<br>\n";
        $this->instanceProperty = $p1;
    }

    protected $instanceProperty;

    public function instanceMethod()
    {
        echo 'instanceMethod() called.'."<br>\n";
        echo '"instanseProperty"='.$this->instanceProperty."<br>\n";
    }
}
