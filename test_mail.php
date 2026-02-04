<?php
require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Mailpit SMTP settings
    $mail->isSMTP();
    $mail->Host       = '127.0.0.1';
    $mail->Port       = 1025;
    $mail->SMTPAuth   = false;
    $mail->SMTPSecure = false;

    // Email content
    $mail->setFrom('dev@example.test', 'Local Dev');
    $mail->addAddress('user@example.test', 'Test User');

    $mail->Subject = 'Mailpit + PHPMailer Test';
    $mail->Body    = 'This email was sent locally using Mailpit.';
    $mail->AltBody = 'Plain text version';

    $mail->send();
    echo "✅ Email sent (captured by Mailpit)\n";

} catch (Exception $e) {
    echo "❌ Mail error: {$mail->ErrorInfo}\n";
}
