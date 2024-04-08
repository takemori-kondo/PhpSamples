<?php
// PHP Version 8.1
declare(strict_types=1);

namespace Php03;

$errorText = $_GET['error-text'];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <title>Inquiry Error</title>
</head>

<body>
    <div id="wrap">
        <header>
            <div>問い合わせエラー</div>
        </header>
        <main>
            <div>
                <?php echo $errorText; ?>
            </div>
        </main>
        <footer>
            <div>Copyright © 2018 &lt;your name&gt; All Rights Reserved. </div>
        </footer>
    </div>
</body>

</html>