<?php
// PHP Version 8.1
declare(strict_types=1);
namespace Php02;

require_once 'myautoload.php';

use Php02\Classes\DataSource;

$pdo = DataSource::openOrInitializeDB();
if (isset($_POST['target-id']) && !empty($_POST['target-id'])) {
    $stmt = DataSource::deleteTodo($pdo, $_POST['target-id']);
}
header('Location: ./index.php');
