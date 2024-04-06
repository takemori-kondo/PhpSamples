<?php
// PHP Version 8.1
declare(strict_types=1);

namespace Php01\Classes;

class MyClass
{
    public static string $staticProperty = '$staticProperty\'s value';

    public static function staticMethod(): void
    {
        echo 'staticMethod() called' . "\n";
        static::staticMethod2();
        self::staticMethod2();
    }

    protected static function staticMethod2(): void
    {
        echo 'MyClass\'s staticMethod2 called' . "\n";
    }

    // static
    ///////////
    // instance

    protected string $instanceProperty;

    public function __construct(string $p1)
    {
        echo '__construct($p1) called. $p1 is ' . $p1  . "\n";
        $this->instanceProperty = $p1;
    }

    public function instanceMethod(): void
    {
        echo 'instanceMethod() called. $instanseProperty=' . $this->instanceProperty  . "\n";
    }
}
