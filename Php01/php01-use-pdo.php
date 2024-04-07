<?php
// PHP Version 8.1
declare(strict_types=1);

namespace Php01;

require_once 'myautoload.php';

use Php01\Classes\DbMysql;
use \Php01\Classes\DbSqlite;

echo '<h1>' . __FILE__ . '</h1>' . "\n";

$isMysql = true;
if ($isMysql) {
    $db = new DbMysql();
    echo '<div>' . $db->getDbVersion() . '</div>' . "\n";
} else {
    $db = new DbSqlite();
    echo '<div>' . $db->getDbVersion() . '</div>' . "\n";
}

$db->initSchema();
$result = $db->getSampleValues();

echo "<pre>\n";
foreach ($result as $value) {
    var_dump($value);
}
echo "</pre>";
