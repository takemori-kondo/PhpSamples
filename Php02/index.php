<?php
/**
 * TODO list sample's index.
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
require_once __DIR__.'/functions.php';

// Get pdo instance.
$pdo = DataSource::openOrInitializeDB();
$stmt = DataSource::getAllTodos($pdo);
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
            <form id="form" method="POST" action="./update.php">
                <input type="hidden" id="target-id" name="target-id" value="">
                <?php $iTab = 1; ?>
                <?php foreach ($stmt as $key => $value) : ?>
                <div>
                    <input name="todos[<?php echo $value['id']; ?>][name]" value="<?php echo $value['name']; ?>"
                        tabindex="<?php echo $iTab++; ?>" type="text">
                    <input name="todos[<?php echo $value['id']; ?>][content]" value="<?php echo $value['content']; ?>"
                        tabindex="<?php echo $iTab++; ?>" type="text">
                    <button name="delete" onclick="submitDataTo('./delete.php', '<?php echo $value['id']; ?>')"
                        tabindex="<?php echo $iTab++; ?>" type="button">削除</button>
                    作成日:
                    <?php
                    $strUtcDate = $value['created'];
                    echo strUtcToStrTokyo($strUtcDate); ?>
                    更新日:
                    <?php
                    $strUtcDate = $value['modified'];
                    echo strUtcToStrTokyo($strUtcDate); ?>
                </div>
                <?php endforeach ?>
                <div>
                    <button name="add" onclick="submitDataTo('./add.php')" tabindex="<?php echo $iTab++; ?>"
                        type="button">保存&amp;追加</button>
                    <button name="add" onclick="submitDataTo('./updateAll.php')" tabindex="<?php echo $iTab++; ?>"
                        type="button">保存</button>
                </div>
            </form>
        </main>
        <footer>
            <div>Copyright © 2018 &lt;your name&gt; All Rights Reserved. </div>
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