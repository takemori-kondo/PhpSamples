<?php
// PHP Version 8.1
declare(strict_types=1);

namespace Php02;

require_once 'myautoload.php';

use Php02\Classes\DataSource;
use Php02\Classes\DateTimeUtil;

DataSource::openOrInitializeDB();
$stmt = DataSource::getAllTodos();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <title>HTML Samples</title>
</head>

<body>
    <div id="wrap">
        <header>
            <div>TODOリスト</div>
        </header>
        <main>
            <div><?php echo DataSource::getDbVersion() ?></div>
            <form id="form" method="POST" action="./update.php">
                <input type="hidden" id="target-id" name="target-id" value="">
                <?php $iTab = 1; ?>
                <?php foreach ($stmt as $key => $value) : ?>
                    <div>
                        <input name="todos[<?php echo $value['id']; ?>][name_old]" value="<?php echo $value['name']; ?>" type="hidden">
                        <input name="todos[<?php echo $value['id']; ?>][name]" value="<?php echo $value['name']; ?>" tabindex="<?php echo $iTab++; ?>" type="text">
                        <input name="todos[<?php echo $value['id']; ?>][content_old]" value="<?php echo $value['content']; ?>" type="hidden">
                        <input name="todos[<?php echo $value['id']; ?>][content]" value="<?php echo $value['content']; ?>" tabindex="<?php echo $iTab++; ?>" type="text">
                        <button name="delete" onclick="submitDataTo('./delete.php', '<?php echo $value['id']; ?>')" tabindex="<?php echo $iTab++; ?>" type="button">削除</button>
                        作成日:
                        <?php
                        $strUtcDate = $value['created'];
                        if (!empty($strUtcDate)) {
                            echo DateTimeUtil::strUtcToStrTokyo($strUtcDate);
                        }
                        ?>
                        更新日:
                        <?php
                        $strUtcDate = $value['modified'];
                        if (!empty($strUtcDate)) {
                            echo DateTimeUtil::strUtcToStrTokyo($strUtcDate);
                        }
                        ?>
                    </div>
                <?php endforeach ?>
                <div>
                    <button name="add" onclick="submitDataTo('./add.php')" tabindex="<?php echo $iTab++; ?>" type="button">保存&amp;追加</button>
                    <button name="add" onclick="submitDataTo('./updateAll.php')" tabindex="<?php echo $iTab++; ?>" type="button">保存</button>
                </div>
            </form>
        </main>
        <footer>
            <div>Copyright © 2022 &lt;your name&gt; All Rights Reserved. </div>
        </footer>
    </div>
    <script>
        function submitDataTo(formAction, opt_id) {
            document
                .getElementById('form')
                .setAttribute('action', formAction);
            document
                .getElementById('target-id')
                .setAttribute('value', opt_id);
            document
                .getElementById('form')
                .submit();
        }
    </script>
</body>

</html>