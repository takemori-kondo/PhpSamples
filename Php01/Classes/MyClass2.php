<?php
// PHP Version 8.1
declare(strict_types=1);

namespace Php01\Classes;

class MyClass2 extends MyClass
{
    public static function staticMethod(): void
    {
        echo 'Overrided static method! ';
        parent::staticMethod();
    }

    protected static function staticMethod2(): void
    {
        echo 'MyClass2\'s staticMethod2 called' . "\n";
    }

    // static
    ///////////
    // instance

    public function instanceMethod(): void
    {
        echo 'Overrided method! ';
        parent::instanceMethod();
    }
}
