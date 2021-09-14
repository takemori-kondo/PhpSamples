<?php
// PHP Version 8.1
namespace Php01\Classes;

class MyClass
{
    public static string $staticProperty = '$staticProperty\'s value';

    public static function staticMethod(): void
    {
        echo 'staticMethod() called' . "<br>\n";
    }

    // static
    ///////////
    // instance

    protected string $instanceProperty;

    public function __construct(string $p1)
    {
        echo '__construct($p1) called. $p1 is ' . $p1 . "<br>\n";
        $this->instanceProperty = $p1;
    }

    public function instanceMethod(): void
    {
        echo 'instanceMethod() called.' . "<br>\n";
        echo '$instanseProperty=' . $this->instanceProperty . "<br>\n";
    }
}
