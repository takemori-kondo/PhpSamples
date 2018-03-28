<?php
/**
 * PDO sample.
 *
 * PHP Version 7.2
 *
 * @category Foo
 * @package  None
 * @author   takemori <foo@bar.baz>
 * @license  https://bar.baz/ MIT License
 * @link     None
 */

require_once __DIR__.'/db-mysql.php';
use DBMysql;

// Get pdo instance.
$pdo = DBMysql::getPdo();
 
// If DB does not exist, creating it.
$dbName = 'php_sample';
$stmt = $pdo->query("SHOW DATABASES LIKE '$dbName'");
if ($stmt->rowCount() <= 0) {
    $pdo->exec("CREATE DATABASE ".$dbName);
}
$pdo->exec("USE ".$dbName);

// If table does not exist, creating it.
$tName = 'sample_values';
$stmt = $pdo->query("SHOW TABLES LIKE '$tName'");
if ($stmt->rowCount() <= 0) {
    $sql = "CREATE TABLE ".$tName."(id INT AUTO_INCREMENT, name VARCHAR(255), PRIMARY KEY(id))";
    $pdo->exec($sql);
    $names = ['Alice', 'Bob', 'Carol', 'Dave'];
    $stmt = $pdo->prepare("INSERT INTO ".$tName."(name) values(:name)");
    foreach ($names as $name) {
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
    }
}

// Select table and output
$tName = $tName;
$stmt = $pdo->query("SELECT * FROM ".$tName." ORDER BY id");
foreach ($stmt as $value) {
    var_dump($value);
}