<?php
// Simple email service without external dependencies
class SimpleEmailService
{
    private $config;

    public function __construct()
    {
        $this->config = require_once __DIR__ . '/../config/email.php';
    }

    public function sendContactForm($formData)
    {
        try {
            // Basic email validation
            if (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
                return ['success' => false, 'message' => 'Invalid email address'];
            }

            // For now, let's use PHP's mail() function
            // In production, configure SMTP settings in your server
            $to = $this->config['admin_email'];
            $subject = 'New Booking Inquiry - Ngoato Mogoshadi Lodge';
            $message = $this->generateEmailBody($formData);
            $headers = $this->buildHeaders($formData);

            // Attempt to send email
            if (mail($to, $subject, $message, $headers)) {
                // Send confirmation to guest
                $this->sendConfirmationEmail($formData['email'], $formData['name'], $formData);
                
                return ['success' => true, 'message' => 'Thank you! Your booking inquiry has been sent successfully. We will get back to you within 24 hours.'];
            } else {
                return ['success' => false, 'message' => 'Sorry, there was an error sending your message. Please try calling us directly at 082 427 6104.'];
            }
            
        } catch (Exception $e) {
            error_log("Email sending failed: " . $e->getMessage());
            return ['success' => false, 'message' => 'Sorry, there was an error sending your message. Please try calling us directly at 082 427 6104.'];
        }
    }

    private function buildHeaders($formData)
    {
        $headers = [];
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=UTF-8';
        $headers[] = 'From: ' . $this->config['from_name'] . ' <' . $this->config['admin_email'] . '>';
        $headers[] = 'Reply-To: ' . $formData['name'] . ' <' . $formData['email'] . '>';
        $headers[] = 'X-Mailer: PHP/' . phpversion();
        
        return implode("\r\n", $headers);
    }

    private function generateEmailBody($data)
    {
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #92400e; color: white; padding: 20px; text-align: center; }
                .content { background-color: #f8f7f5; padding: 30px; }
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
                        <div class="value"><span class="label">Email:</span> ' . htmlspecialchars($data['email']) . '</div>';
        
        if (!empty($data['phone'])) {
            $html .= '<div class="value"><span class="label">Phone:</span> ' . htmlspecialchars($data['phone']) . '</div>';
        }
        
        $html .= '
                    </div>
                    
                    <div class="section">
                        <h3 style="color: #44403c; border-bottom: 2px solid #fbbf24; padding-bottom: 5px;">Booking Details</h3>
                        <div class="value"><span class="label">Check-in Date:</span> ' . htmlspecialchars($data['checkin']) . '</div>
                        <div class="value"><span class="label">Check-out Date:</span> ' . htmlspecialchars($data['checkout']) . '</div>
                    </div>';
        
        if (!empty($data['message'])) {
            $html .= '
                    <div class="section">
                        <h3 style="color: #44403c; border-bottom: 2px solid #fbbf24; padding-bottom: 5px;">Special Requests</h3>
                        <div class="highlight">' . nl2br(htmlspecialchars($data['message'])) . '</div>
                    </div>';
        }
        
        $html .= '
                    <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e7e5e4;">
                        <p style="color: #78716c; font-size: 14px; margin: 0;">
                            This inquiry was submitted through the Ngoato Mogoshadi Lodge website.
                        </p>
                    </div>
                </div>
            </div>
        </body>
        </html>';
        
        return $html;
    }

    public function sendConfirmationEmail($guestEmail, $guestName, $formData)
    {
        try {
            $subject = 'Booking Inquiry Received - Ngoato Mogoshadi Lodge';
            $message = $this->generateConfirmationBody($guestName, $formData);
            $headers = $this->buildConfirmationHeaders();

            return mail($guestEmail, $subject, $message, $headers);
            
        } catch (Exception $e) {
            error_log("Confirmation email failed: " . $e->getMessage());
            return false;
        }
    }

    private function buildConfirmationHeaders()
    {
        $headers = [];
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=UTF-8';
        $headers[] = 'From: ' . $this->config['from_name'] . ' <' . $this->config['admin_email'] . '>';
        $headers[] = 'Reply-To: ' . $this->config['admin_email'];
        $headers[] = 'X-Mailer: PHP/' . phpversion();
        
        return implode("\r\n", $headers);
    }

    private function generateConfirmationBody($guestName, $data)
    {
        return '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background-color: #92400e; color: white; padding: 20px; text-align: center; }
                .content { background-color: #f8f7f5; padding: 30px; }
                .highlight { background-color: #fef3c7; padding: 20px; border-radius: 8px; margin: 20px 0; color: #92400e; }
                .contact-info { text-align: center; margin: 25px 0; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1>Thank You!</h1>
                </div>
                <div class="content">
                    <p>Dear ' . htmlspecialchars($guestName) . ',</p>
                    
                    <p>Thank you for your interest in Ngoato Mogoshadi Lodge. We have received your booking inquiry for:</p>
                    
                    <div class="highlight">
                        <p><strong>Check-in:</strong> ' . htmlspecialchars($data['checkin']) . '</p>
                        <p><strong>Check-out:</strong> ' . htmlspecialchars($data['checkout']) . '</p>
                    </div>
                    
                    <p>Our team will review your request and get back to you within 24 hours with availability and pricing details.</p>
                    
                    <p>If you have any immediate questions, please don\'t hesitate to contact us:</p>
                    
                    <div class="contact-info">
                        <p><strong>Phone:</strong> 082 427 6104</p>
                        <p><strong>Email:</strong> ngoatomogoshadi7@gmail.com</p>
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
}