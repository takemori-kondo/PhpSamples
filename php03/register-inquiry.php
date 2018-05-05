<?php
/**
 * Inquiry sample's inquiry-confirm.php.
 *
 * PHP Version 7.2
 *
 * @category Foo
 * @package  None
 * @author   takemori <foo@bar.baz>
 * @license  https://bar.baz/ MIT License
 * @link     None
 */

namespace Php03;

require_once "vendor/autoload.php";
require_once __DIR__.'/Email.php';

$name = $_POST['name'];
$email = $_POST['email'];
$sex = $_POST['sex'];
$inquiryType = $_POST['inquiry-type'];
$inquiryDetails = $_POST['inquiry-details'];

try {
    // Let's use mail trapping service.
    // https://mailtrap.io/
    $host = 'smtp.mailtrap.io';
    $port = 2525;
    $user = '7387aad7ba7380';
    $pass = '5537ae2f39e233';
    $toList = [$email];
    $from = 'user01@example.com';
    $fromName = 'ユーザー01';
    $subject = '【お問い合わせサンプル】お問い合わせありがとうございました';
    $body = <<<EOT
【お問い合わせサンプル】より

お問い合わせありがとうございます。
下記内容にて、お問い合わせを受け付けました。
EOT;
    $body .= "\n\n";
    $body .= '名前'."\n".$name."\n\n";
    $body .= 'メール'."\n".$email."\n\n";
    $body .= '性別'."\n".$sex."\n\n";
    $body .= 'お問い合わせ種類'."\n".$inquiryType."\n\n";
    $body .= 'お問い合わせ内容'."\n".$inquiryDetails."\n\n";

    $smtp = new Email($host, $port, $user, $pass);
    $smtp->send($toList, null, null, $from, $fromName, $subject, $body);
    $smtp->send(null, [$from], null, $from, $fromName, $subject, $body);
    $smtp->send(null, null, [$from], $from, $fromName, $subject, $body);
    header("Location: ./inquiry-complete.html");
} catch (\Exception $e) {
    header("Location: ./inquiry-error.php?error-text=".$e->getMessage());
}
