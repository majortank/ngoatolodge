<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    private $config;
    private $mail;

    public function __construct()
    {
        $this->config = require __DIR__ . '/../config/email.php';
        $this->mail = new PHPMailer(true);
        $this->setupSMTP();
    }

    private function setupSMTP()
    {
        $this->mail->isSMTP();
        $this->mail->Host = $this->config['smtp_host'];
        $this->mail->Port = $this->config['smtp_port'];
        $this->mail->SMTPAuth = $this->config['smtp_auth'];
        $this->mail->SMTPSecure = $this->config['smtp_secure'];
        
        if ($this->config['smtp_auth']) {
            $this->mail->Username = $this->config['smtp_username'];
            $this->mail->Password = $this->config['smtp_password'];
        }
    }

    public function sendContactForm($formData)
    {
        try {
            // Send admin notification
            $adminSent = $this->sendAdminNotification($formData);
            
            // Send guest confirmation
            $guestSent = $this->sendGuestConfirmation($formData);
            
            if ($adminSent) {
                return [
                    'success' => true,
                    'message' => 'Thank you! Your booking inquiry has been sent successfully. We will get back to you within 24 hours.'
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Sorry, there was an error sending your message. Please try calling us directly at 082 427 6104.'
                ];
            }
            
        } catch (Exception $e) {
            error_log("Email sending failed: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Email error: ' . $e->getMessage()
            ];
        }
    }

    private function sendAdminNotification($formData)
    {
        try {
            $mail = clone $this->mail;
            
            // Recipients
            $mail->setFrom($this->config['from_email'], $this->config['from_name']);
            $mail->addAddress($this->config['admin_email']);
            $mail->addReplyTo($formData['email'], $formData['name']);
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = 'New Booking Inquiry - Ngoato Mogoshadi Lodge';
            $mail->Body = $this->generateAdminEmailBody($formData);
            $mail->AltBody = $this->generateAdminEmailPlainText($formData);
            
            return $mail->send();
            
        } catch (Exception $e) {
            error_log("Admin notification failed: " . $e->getMessage());
            throw $e;
        }
    }

    private function sendGuestConfirmation($formData)
    {
        try {
            $mail = clone $this->mail;
            
            // Recipients
            $mail->setFrom($this->config['from_email'], $this->config['from_name']);
            $mail->addAddress($formData['email'], $formData['name']);
            $mail->addReplyTo($this->config['reply_to'], $this->config['from_name']);
            
            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Booking Inquiry Received - Ngoato Mogoshadi Lodge';
            $mail->Body = $this->generateGuestEmailBody($formData);
            $mail->AltBody = $this->generateGuestEmailPlainText($formData);
            
            return $mail->send();
            
        } catch (Exception $e) {
            error_log("Guest confirmation failed: " . $e->getMessage());
            throw $e;
        }
    }

    private function generateAdminEmailBody($data)
    {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #92400e; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
                .content { background-color: #f8f7f5; padding: 30px; border-radius: 0 0 8px 8px; }
                .section { margin-bottom: 20px; }
                .label { font-weight: bold; color: #44403c; }
                .value { color: #57534e; margin-bottom: 10px; }
                .highlight { background-color: #fef3c7; padding: 15px; border-radius: 8px; color: #92400e; margin: 15px 0; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>New Booking Inquiry</h1>
                </div>
                <div class="content">
                    <div class="section">
                        <h3 style="color: #44403c; border-bottom: 2px solid #fbbf24; padding-bottom: 5px;">Guest Information</h3>
                        <div class="value"><span class="label">Name:</span> ' . htmlspecialchars($data['name']) . '</div>
                        <div class="value"><span class="label">Email:</span> ' . htmlspecialchars($data['email']) . '</div>
                        ' . (!empty($data['phone']) ? '<div class="value"><span class="label">Phone:</span> ' . htmlspecialchars($data['phone']) . '</div>' : '') . '
                    </div>
                    
                    <div class="section">
                        <h3 style="color: #44403c; border-bottom: 2px solid #fbbf24; padding-bottom: 5px;">Booking Details</h3>
                        <div class="value"><span class="label">Check-in Date:</span> ' . htmlspecialchars($data['checkin']) . '</div>
                        <div class="value"><span class="label">Check-out Date:</span> ' . htmlspecialchars($data['checkout']) . '</div>
                    </div>
                    
                    ' . (!empty($data['message']) ? '
                    <div class="section">
                        <h3 style="color: #44403c; border-bottom: 2px solid #fbbf24; padding-bottom: 5px;">Special Requests</h3>
                        <div class="highlight">' . nl2br(htmlspecialchars($data['message'])) . '</div>
                    </div>' : '') . '
                    
                    <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e7e5e4;">
                        <p style="color: #78716c; font-size: 14px; margin: 0;">
                            This inquiry was submitted through the Ngoato Mogoshadi Lodge website.
                        </p>
                    </div>
                </div>
            </div>
        </body>
        </html>';
    }

    private function generateAdminEmailPlainText($data)
    {
        $text = "NEW BOOKING INQUIRY\n\n";
        $text .= "GUEST INFORMATION\n";
        $text .= "Name: {$data['name']}\n";
        $text .= "Email: {$data['email']}\n";
        if (!empty($data['phone'])) {
            $text .= "Phone: {$data['phone']}\n";
        }
        $text .= "\nBOOKING DETAILS\n";
        $text .= "Check-in: {$data['checkin']}\n";
        $text .= "Check-out: {$data['checkout']}\n";
        if (!empty($data['message'])) {
            $text .= "\nSPECIAL REQUESTS\n{$data['message']}\n";
        }
        return $text;
    }

    private function generateGuestEmailBody($data)
    {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #92400e; color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
                .content { background-color: #f8f7f5; padding: 30px; border-radius: 0 0 8px 8px; }
                .highlight { background-color: #fef3c7; padding: 20px; border-radius: 8px; margin: 20px 0; color: #92400e; }
                .contact-info { text-align: center; margin: 25px 0; background: white; padding: 20px; border-radius: 8px; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>Thank You!</h1>
                </div>
                <div class="content">
                    <p>Dear ' . htmlspecialchars($data['name']) . ',</p>
                    
                    <p>Thank you for your interest in Ngoato Mogoshadi Lodge. We have received your booking inquiry for:</p>
                    
                    <div class="highlight">
                        <p style="margin: 5px 0;"><strong>Check-in:</strong> ' . htmlspecialchars($data['checkin']) . '</p>
                        <p style="margin: 5px 0;"><strong>Check-out:</strong> ' . htmlspecialchars($data['checkout']) . '</p>
                    </div>
                    
                    <p>Our team will review your request and get back to you within 24 hours with availability and pricing details.</p>
                    
                    <p>If you have any immediate questions, please don\'t hesitate to contact us:</p>
                    
                    <div class="contact-info">
                        <p style="margin: 5px 0;"><strong>Phone:</strong> 082 427 6104</p>
                        <p style="margin: 5px 0;"><strong>Email:</strong> ngoatomogoshadi7@gmail.com</p>
                    </div>
                    
                    <p>We look forward to hosting you!</p>
                    
                    <p>
                        Warm regards,<br>
                        <strong>Ngoato Mogoshadi Lodge Team</strong>
                    </p>
                </div>
            </div>
        </body>
        </html>';
    }

    private function generateGuestEmailPlainText($data)
    {
        $text = "Dear {$data['name']},\n\n";
        $text .= "Thank you for your interest in Ngoato Mogoshadi Lodge.\n\n";
        $text .= "We have received your booking inquiry for:\n";
        $text .= "Check-in: {$data['checkin']}\n";
        $text .= "Check-out: {$data['checkout']}\n\n";
        $text .= "Our team will review your request and get back to you within 24 hours.\n\n";
        $text .= "Contact us:\n";
        $text .= "Phone: 082 427 6104\n";
        $text .= "Email: ngoatomogoshadi7@gmail.com\n\n";
        $text .= "Warm regards,\nNgoato Mogoshadi Lodge Team";
        return $text;
    }
}
