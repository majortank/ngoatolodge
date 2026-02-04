<?php
// Email configuration

return [
    // SMTP settings
    'smtp_host' => getenv('SMTP_HOST') ?: '127.0.0.1',        // Mailpit for local dev
    'smtp_port' => getenv('SMTP_PORT') ?: 1025,               // Mailpit SMTP port
    'smtp_auth' => getenv('SMTP_AUTH') === 'true' ? true : false,
    'smtp_secure' => getenv('SMTP_SECURE') ?: false,          // false for Mailpit, 'tls' for production
    'smtp_username' => getenv('SMTP_USERNAME') ?: '',
    'smtp_password' => getenv('SMTP_PASSWORD') ?: '',
    
    // Email addresses
    'from_email' => getenv('FROM_EMAIL') ?: 'info@ngoatom.co.za',
    'from_name' => getenv('FROM_NAME') ?: 'Ngoato Mogoshadi Lodge',
    'admin_email' => getenv('ADMIN_EMAIL') ?: 'ngoatomogoshadi7@gmail.com',
    'reply_to' => getenv('REPLY_TO') ?: 'info@ngoatom.co.za',
];
