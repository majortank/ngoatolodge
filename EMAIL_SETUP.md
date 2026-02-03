# Email Setup Instructions

## Current Setup
The contact form is currently using PHP's built-in `mail()` function which works on most shared hosting providers. 

## To Upgrade to SMTP with PHPMailer

### 1. Install Composer (if not already installed)
```bash
# On Ubuntu/Debian
sudo apt update
sudo apt install composer

# On CentOS/RHEL
sudo dnf install composer
```

### 2. Install PHPMailer
```bash
cd /home/thabot/ngoatolodge
composer install
```

### 3. Configure SMTP Settings
Edit `/home/thabot/ngoatolodge/config/email.php` and fill in your SMTP details:

```php
return [
    'smtp_host' => 'smtp.gmail.com',  // For Gmail
    'smtp_port' => 587,
    'smtp_secure' => 'tls',
    'smtp_username' => 'your-email@gmail.com',
    'smtp_password' => 'your-app-password', // Use app password for Gmail
    'from_email' => 'your-email@gmail.com',
    'from_name' => 'Ngoato Mogoshadi Lodge',
    'reply_to' => 'ngoatomogoshadi7@gmail.com',
    'admin_email' => 'ngoatomogoshadi7@gmail.com'
];
```

### 4. Switch to PHPMailer
Replace the include in `api/contact.php`:
```php
// Change this line:
require_once __DIR__ . '/../includes/SimpleEmailService.php';

// To this:
require_once __DIR__ . '/../includes/EmailService.php';

// And change this line:
$emailService = new SimpleEmailService();

// To this:
$emailService = new EmailService();
```

## Gmail App Password Setup
1. Enable 2-Factor Authentication on your Gmail account
2. Go to Google Account settings > Security > 2-Step Verification
3. Generate an App Password for "Mail"
4. Use this app password in the configuration

## Other Email Providers
- **Outlook/Hotmail**: smtp.live.com, port 587, TLS
- **Yahoo**: smtp.mail.yahoo.com, port 587, TLS  
- **Custom SMTP**: Contact your hosting provider for details

## Testing
After setup, test the contact form to ensure emails are being sent and received properly.