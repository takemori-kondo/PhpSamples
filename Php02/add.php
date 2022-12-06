<?php
// PHP Version 8.1
declare(strict_types=1);
namespace Php02;

require_once 'myautoload.php';

use Php02\Classes\DataSource;

$pdo = DataSource::openOrInitializeDB();
$todos = $_POST['todos'];
$updateTargetTodos = array();
foreach ($todos as $id => $assoc) {
    if ($assoc['name'] != $assoc['name_old'] || $assoc['content'] != $assoc['content_old']) {
        $updateTargetTodos["$id"] = $assoc;
    }
}
$stmt = DataSource::updateAllTodos($pdo, $updateTargetTodos);
$stmt = DataSource::addTodo($pdo);
header('Location: ./index.php');
