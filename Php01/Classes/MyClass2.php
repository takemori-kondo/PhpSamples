<?php
// PHP Version 8.1
namespace Php01\Classes;

class MyClass2 extends MyClass
{
    public function instanceMethod(): void
    {
        echo 'Overrided method!' . "<br>\n";
        parent::instanceMethod();
    }
}
