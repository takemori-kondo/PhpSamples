<?php
// PHP Version 8.1
declare(strict_types=1);
namespace Php01;

require_once 'myautoload.php';

// use \Php01\Classes\DbMysql;
use \Php01\Classes\DbSqlite;

echo '<h1>'.__FILE__.'</h1>'."\n";

// $pdo = DbMysql::getPdo();
$pdo = DbSqlite::getPdo();

// If DB does not exist, creating it.
/*
$dbName = 'php_sample';
if ($pdo->query("SHOW DATABASES LIKE '$dbName'")->rowCount() <= 0) {
    $pdo->exec("CREATE DATABASE ".$dbName);
}
$pdo->exec("USE ".$dbName);
*/

// If table does not exist, creating it.
$tableName = 'sample_values';
// $selectTableName = "SHOW TABLES LIKE '$tableName'";
$selectTableName = "SELECT name FROM sqlite_master WHERE type='table' AND name='$tableName'";
$data = $pdo->query($selectTableName)->fetchAll();
if (count($data) <= 0) {
    // $sql = "CREATE TABLE ".$tableName."(id BIGINT AUTO_INCREMENT, name VARCHAR(255), PRIMARY KEY(id))";
    $sql = "CREATE TABLE ".$tableName."(id INTEGER PRIMARY KEY, name)";
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
echo "<pre>\n";
foreach ($stmt as $value) {
    var_dump($value);
}
echo "</pre>";
