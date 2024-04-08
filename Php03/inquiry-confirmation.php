<?php
// PHP Version 8.1
declare(strict_types=1);

namespace Php03;

$name = $_POST['name'];
$email = $_POST['email'];
$sex = $_POST['sex'];
$inquiryType = $_POST['inquiry-type'];
$inquiryDetails = $_POST['inquiry-details'];
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <title>Inquiry Confirmation</title>
</head>

<body>
    <div id="wrap">
        <header>
            <div>問い合わせ確認</div>
        </header>
        <main>
            <form method="POST" action="./register-inquiry.php">
                <fieldset>
                    <legend>入力項目</legend>
                    <input type="hidden" name="name" value="<?php echo $name; ?>">
                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                    <input type="hidden" name="sex" value="<?php echo $sex; ?>">
                    <input type="hidden" name="inquiry-type" value="<?php echo $inquiryType; ?>">
                    <input type="hidden" name="inquiry-details" value="<?php echo $inquiryDetails; ?>">
                    <div>
                        <span class="caption">名前</span>
                        <span class="colon">:</span>
                        <span class="input-text">
                            <?php echo $name; ?>
                        </span>
                    </div>
                    <div>
                        <span class="caption">メール</span>
                        <span class="colon">:</span>
                        <span class="input-text">
                            <?php echo $email; ?>
                        </span>
                    </div>
                    <div>
                        <span class="caption">性別</span>
                        <span class="colon">:</span>
                        <span class="input-text">
                            <?php echo $sex; ?>
                        </span>
                    </div>
                    <div>
                        <span class="caption">お問い合わせ種類</span>
                        <span class="colon">:</span>
                        <span class="input-text">
                            <?php echo $inquiryType; ?>
                        </span>
                    </div>
                    <div>
                        <span class="caption">お問い合わせ内容</span>
                        <span class="colon">:</span>
                        <span class="input-text">
                            <?php echo $inquiryDetails; ?>
                        </span>
                    </div>
                </fieldset>
                <button type="submit" tabindex="70" accesskey="s">送信</button>
            </form>
        </main>
        <footer>
            <div>Copyright © 2018 &lt;your name&gt; All Rights Reserved. </div>
        </footer>
    </div>
</body>

</html>