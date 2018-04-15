<?php
/**
 * Statements sample.
 *
 * PHP Version 7.2
 *
 * @category Foo
 * @package  None
 * @author   takemori <foo@bar.baz>
 * @license  https://bar.baz/ MIT License
 * @link     None
 */
namespace Php01;

$metaVars = ['foo' => 'Alice', 'bar' => 'Bob', 'baz' => 'Carol'];
echo $metaVars.'<br>';
var_dump($metaVars);

if (in_array('Bob', $metaVars)) {
    echo 'if statement is TRUE! "value=Bob" found.'.'<br>';
}
if (array_key_exists('qux', $metaVars)) {
} else {
    echo 'if statement is FALSE! "key=qux" not found.'.'<br>';
}
echo '<br>';

while (count($metaVars) < 5) {
    $x = 'xxx';
    array_push($metaVars, $x);
    echo 'Add '.$x.'<br>';
}
var_dump($metaVars);
echo '<br>';

foreach ($metaVars as $key => $val) {
    echo $key.' is '.$val.'<br>';
}
echo '<br>';

$cnt = count($metaVars);
for ($i=0; $i < $cnt; $i++) {
    echo '$metaVars['.$i.'] = '.$metaVars[$i].'<br>';
}
