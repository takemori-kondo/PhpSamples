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

use PHPMailer\PHPMailer\PHPMailer as PHPMailer;

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
    $authUser = '7387aad7ba7380';
    $authPass = '5537ae2f39e233';
    $to = $email;
    $from = 'user01@example.com';
    $fromName = 'ユーザー01';
    $subject = '【お問い合わせサンプル】お問い合わせありがとうございました';
    $body = getBodyText($name, $email, $sex, $inquiryType, $inquiryDetails);
    $errorInfo = sendMail($host, $port, $authUser, $authPass, $to, $from, $fromName, $subject, $body);
    if (!empty($errorInfo) && 0 < strlen($errorInfo)) {
        throw new \Exception($errorInfo);
    }
    header("Location: ./inquiry-complete.html");
} catch (\Exception $e) {
    header("Location: ./inquiry-error.php?error-text=".$e->getMessage());
}

function getBodyText($name, $email, $sex, $inquiryType, $inquiryDetails)
{
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
    return $body;
}

function sendMail($host, $port, $authUser, $authPass, $to, $from, $fromName, $subject, $body)
{
    // Let's use PHPMailer.
    // composer require phpmailer/phpmailer
    $phpmailer = new PHPMailer();
    $phpmailer->CharSet = "UTF-8";

    $phpmailer->isSMTP();
    $phpmailer->isHtmL(false);
    $phpmailer->Host = $host;
    $phpmailer->SMTPAuth = true;
    $phpmailer->SMTPSecure = 'tls';
    $phpmailer->Port = $port;
    $phpmailer->Username = $authUser;
    $phpmailer->Password = $authPass;
    $phpmailer->addAddress($to);
    $phpmailer->From = $from;
    $phpmailer->FromName = $fromName;
    $phpmailer->Subject = mb_encode_mimeheader($subject); // Base64
    $phpmailer->Body = $body;
    $phpmailer->send();
    return $phpmailer->ErrorInfo;
}
