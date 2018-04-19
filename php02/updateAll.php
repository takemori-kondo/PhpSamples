<?php
/**
 * TODO list sample's updater.
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

require_once __DIR__.'/db-mysql.php';
require_once __DIR__.'/data-source.php';

$pdo = DataSource::openOrInitializeDB();

$todos = $_POST['todos'];
$stmt = DataSource::updateAllTodos($pdo, $todos);
header("Location: ./index.php");
