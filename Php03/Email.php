<?php
// PHP Version 8.1
declare(strict_types=1);

namespace Php03;

use PHPMailer\PHPMailer\PHPMailer as PHPMailer;

class Email
{
    /**
     * PHPMailer for smtp.
     *
     * @var PHPMailer $smtp_
     */
    private $smtp_;

    /**
     * Constructor.
     *
     * @param string  $host    Host name.
     * @param integer $port    Port.
     * @param string  $user    User name.
     * @param string  $pass    Password.
     * @param bool    $isAuth  Uses auth. Default is true.
     * @param string  $sslType 'ssl' or 'tls'. Default is 'tls'.
     */
    public function __construct($host, $port, $user, $pass, $isAuth = true, $sslType = 'tls')
    {
        // Let's use PHPMailer.
        // composer require phpmailer/phpmailer
        $this->smtp_ = new PHPMailer();
        $this->smtp_->CharSet = "UTF-8";
        $this->smtp_->isSMTP();
        $this->smtp_->isHTML(false);
        $this->smtp_->Host = $host;
        $this->smtp_->Port = $port;
        $this->smtp_->Username = $user;
        $this->smtp_->Password = $pass;
        $this->smtp_->SMTPAuth = $isAuth;
        $this->smtp_->SMTPSecure = $sslType;
    }

    /**
     * Send e-mail.
     *
     * @param array  $toList   To list.
     * @param array  $ccList   CC list.
     * @param array  $bccList  Bcc list.
     * @param string $from     From.
     * @param string $fromName From name.
     * @param string $subject  Subject.
     * @param string $body     Body text.
     *
     * @return void
     */
    public function send($toList, $ccList, $bccList, $from, $fromName, $subject, $body)
    {
        // null coalescing
        $toList = $toList ?? [];
        $ccList = $ccList ?? [];
        $bccList = $bccList ?? [];

        // Clear error, to, cc, bcc, attached files.
        $this->smtp_->ErrorInfo = '';
        $this->smtp_->clearAllRecipients();
        $this->smtp_->clearAttachments();

        // Send
        foreach ($toList as $key => $to) {
            $this->smtp_->addAddress($to);
        }
        foreach ($ccList as $key => $cc) {
            $this->smtp_->addCC($cc);
        }
        foreach ($bccList as $key => $bcc) {
            $this->smtp_->addBcc($bcc);
        }
        $this->smtp_->From = $from;
        $this->smtp_->FromName = $fromName;
        $this->smtp_->Subject = mb_encode_mimeheader($subject); // Base64
        $this->smtp_->Body = $body;
        $this->smtp_->send();
        $errorInfo = $this->smtp_->ErrorInfo;
        if (!empty($errorInfo) && 0 < strlen($errorInfo)) {
            throw new \Exception($errorInfo);
        }
    }
}
