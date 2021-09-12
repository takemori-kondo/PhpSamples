<?php
// PHP Version 8.1

namespace Php01;

ini_set('display_errors', 1);

require_once 'myautoload.php';

use \Php01\Classes\DbMysql;

echo '<h1>'.__FILE__.'</h1>'."\n";

$pdo = DbMysql::getPdo();

// If DB does not exist, creating it.
$dbName = 'php_sample';
if ($pdo->query("SHOW DATABASES LIKE '$dbName'")->rowCount() <= 0) {
    $pdo->exec("CREATE DATABASE ".$dbName);
}
$pdo->exec("USE ".$dbName);

// If table does not exist, creating it.
$tableName = 'sample_values';
if ($pdo->query("SHOW TABLES LIKE '$tableName'")->rowCount() <= 0) {
    $sql = "CREATE TABLE ".$tableName."(id BIGINT AUTO_INCREMENT, name VARCHAR(255), PRIMARY KEY(id))";
    $pdo->exec($sql);
    $names = ['Alice', 'Bob', 'Carol', 'Dave'];
    $stmt = $pdo->prepare("INSERT INTO ".$tableName."(name) values(:name)");
    foreach ($names as $name) {
        $stmt->bindParam(':name', $name, \PDO::PARAM_STR);
        $stmt->execute();
    }
}

// Select table and output
$tableName = 'sample_values';
$stmt = $pdo->query("SELECT * FROM ".$tableName." ORDER BY id");
foreach ($stmt as $value) {
    var_dump($value);
}
