<?php
// Email configuration with optional .env support (no secrets in repo)

// Lightweight .env loader (no external dependency)
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#')) {
            continue;
        }
        [$key, $value] = array_pad(explode('=', $line, 2), 2, '');
        $key = trim($key);
        $value = trim($value, " \t\n\r\0\x0B\"");
        if ($key !== '' && getenv($key) === false) {
            putenv("$key=$value");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

return [
    // Email service type: 'smtp' or 'mail'
    // Use 'mail' for cPanel/shared hosting (default)
    // Use 'smtp' for custom SMTP servers (requires PHPMailer)
    'service' => getenv('EMAIL_SERVICE') ?: 'mail',
    
    // SMTP settings (only used when service='smtp')
    'smtp_host' => getenv('SMTP_HOST') ?: 'smtp.gmail.com',
    'smtp_port' => getenv('SMTP_PORT') ?: 587,
    'smtp_secure' => getenv('SMTP_SECURE') ?: 'tls',
    'smtp_username' => getenv('SMTP_USERNAME') ?: 'ngoatomogoshadi7@gmail.com',
    'smtp_password' => getenv('SMTP_PASSWORD') ?: '', // Set via .env or environment
    
    // Basic email settings
    // from_email: Your domain email (e.g., info@yourdomain.com) - update with your actual domain
    'from_email' => getenv('FROM_EMAIL') ?: 'info@ngoatom.co.za',
    'from_name' => getenv('FROM_NAME') ?: 'Ngoato Mogoshadi Lodge',
    // reply_to: Where guests can reply (your domain email)
    'reply_to' => getenv('REPLY_TO') ?: 'info@ngoatom.co.za',
    // admin_email: Where booking notifications are sent (your Gmail)
    'admin_email' => getenv('ADMIN_EMAIL') ?: 'ngoatomogoshadi7@gmail.com'
];