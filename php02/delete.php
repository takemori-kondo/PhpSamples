<?php
/**
 * TODO list sample's deleter.
 *
 * PHP Version 7.2
 *
 * @category Foo
 * @package  None
 * @author   takemori <foo@bar.baz>
 * @license  https://bar.baz/ MIT License
 * @link     None
 */
namespace Php02;

require_once __DIR__.'/DBMysql.php';
require_once __DIR__.'/DataSource.php';

$pdo = DataSource::openOrInitializeDB();
if (isset($_POST['target-id']) && !empty($_POST['target-id'])) {
    $stmt = DataSource::deleteTodo($pdo, $_POST['target-id']);
}
header("Location: ./index.php");
