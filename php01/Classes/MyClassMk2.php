<?php
// PHP Version 8.1

namespace Php01;

class MyClassMk2 extends MyClass
{
    public function instanceMethod()
    {
        echo 'Overrided method!'."<br>\n";
        echo '"instanseProperty"='.$this->instanceProperty."<br>\n";
    }
}
