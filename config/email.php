<?php
// Email configuration
// This uses PHP's built-in mail() function for now
// To upgrade to SMTP, add your details below and switch to PHPMailer

return [
    // SMTP settings (for future PHPMailer implementation)
    'smtp_host' => '', // e.g., 'smtp.gmail.com'
    'smtp_port' => 587, // Usually 587 for TLS or 465 for SSL
    'smtp_secure' => 'tls', // 'tls' or 'ssl'
    'smtp_username' => '', // Your email address
    'smtp_password' => '', // Your email password or app password
    
    // Basic email settings
    'from_email' => 'ngoatomogoshadi7@gmail.com', // From email address
    'from_name' => 'Ngoato Mogoshadi Lodge',
    'reply_to' => 'ngoatomogoshadi7@gmail.com',
    'admin_email' => 'ngoatomogoshadi7@gmail.com' // Where to send contact form submissions
];