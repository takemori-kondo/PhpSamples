<?php
// PHP Version 8.1
declare(strict_types=1);

require_once($_SERVER['DOCUMENT_ROOT'].'/PhpSamples/Php01/Utils/logging.php');

logInfo('ログ出力確認1');
logError('ログ出力確認2');
echo '$_SERVER[\'SERVER_ADDR\']:'.$_SERVER['SERVER_ADDR'].'<br>';
echo '$_SERVER[\'DOCUMENT_ROOT\']:'.$_SERVER['DOCUMENT_ROOT'].'<br>';
echo 'error_log:'.ini_get('error_log').'<br>';

session_start();
$text;
if (isset($_SESSION['session_id_16']) && !empty($_SESSION['session_id_16'])) {
    $text = 'Loaded session!:';
}
else {
    $text = 'New session!:';
}
$_SESSION['session_id_16'] = substr(session_id(), 0, 16);
echo $text.$_SESSION['session_id_16'];
phpinfo();