<?php
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    private $config;
    private $mail;

    public function __construct()
    {
        $this->config = require_once __DIR__ . '/../config/email.php';
        $this->mail = new PHPMailer(true);
        $this->setupSMTP();
    }

    private function setupSMTP()
    {
        $this->mail->isSMTP();
        $this->mail->Host = $this->config['smtp_host'];
        $this->mail->SMTPAuth = true;
        $this->mail->Username = $this->config['smtp_username'];
        $this->mail->Password = $this->config['smtp_password'];
        $this->mail->SMTPSecure = $this->config['smtp_secure'];
        $this->mail->Port = $this->config['smtp_port'];
        
        // Optional: Disable SSL verification (only for development)
        // $this->mail->SMTPOptions = array(
        //     'ssl' => array(
        //         'verify_peer' => false,
        //         'verify_peer_name' => false,
        //         'allow_self_signed' => true
        //     )
        // );
    }

    public function sendContactForm($formData)
    {
        try {
            // Recipients
            $this->mail->setFrom($this->config['from_email'], $this->config['from_name']);
            $this->mail->addAddress($this->config['admin_email']);
            $this->mail->addReplyTo($formData['email'], $formData['name']);

            // Content
            $this->mail->isHTML(true);
            $this->mail->Subject = 'New Booking Inquiry - Ngoato Mogoshadi Lodge';
            
            $body = $this->generateEmailBody($formData);
            $this->mail->Body = $body;
            $this->mail->AltBody = strip_tags($body);

            $this->mail->send();
            return ['success' => true, 'message' => 'Thank you! Your booking inquiry has been sent successfully.'];
            
        } catch (Exception $e) {
            error_log("Email sending failed: " . $this->mail->ErrorInfo);
            return ['success' => false, 'message' => 'Sorry, there was an error sending your message. Please try calling us directly.'];
        }
    }

    private function generateEmailBody($data)
    {
        $html = '
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f8f7f5;">
            <div style="background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <div style="text-align: center; margin-bottom: 30px;">
                    <h1 style="color: #92400e; margin: 0; font-size: 28px;">New Booking Inquiry</h1>
                    <div style="width: 50px; height: 3px; background-color: #fbbf24; margin: 10px auto;"></div>
                </div>
                
                <div style="margin-bottom: 25px;">
                    <h3 style="color: #44403c; margin-bottom: 15px; border-bottom: 2px solid #fbbf24; padding-bottom: 5px;">Guest Information</h3>
                    <p style="margin: 8px 0; color: #57534e;"><strong>Name:</strong> ' . htmlspecialchars($data['name']) . '</p>
                    <p style="margin: 8px 0; color: #57534e;"><strong>Email:</strong> ' . htmlspecialchars($data['email']) . '</p>';
        
        if (!empty($data['phone'])) {
            $html .= '<p style="margin: 8px 0; color: #57534e;"><strong>Phone:</strong> ' . htmlspecialchars($data['phone']) . '</p>';
        }
        
        $html .= '
                </div>
                
                <div style="margin-bottom: 25px;">
                    <h3 style="color: #44403c; margin-bottom: 15px; border-bottom: 2px solid #fbbf24; padding-bottom: 5px;">Booking Details</h3>
                    <p style="margin: 8px 0; color: #57534e;"><strong>Check-in Date:</strong> ' . htmlspecialchars($data['checkin']) . '</p>
                    <p style="margin: 8px 0; color: #57534e;"><strong>Check-out Date:</strong> ' . htmlspecialchars($data['checkout']) . '</p>
                </div>';
        
        if (!empty($data['message'])) {
            $html .= '
                <div style="margin-bottom: 25px;">
                    <h3 style="color: #44403c; margin-bottom: 15px; border-bottom: 2px solid #fbbf24; padding-bottom: 5px;">Special Requests</h3>
                    <div style="background-color: #fef3c7; padding: 15px; border-radius: 8px; color: #92400e;">
                        ' . nl2br(htmlspecialchars($data['message'])) . '
                    </div>
                </div>';
        }
        
        $html .= '
                <div style="text-align: center; margin-top: 30px; padding-top: 20px; border-top: 1px solid #e7e5e4;">
                    <p style="color: #78716c; font-size: 14px; margin: 0;">
                        This inquiry was submitted through the Ngoato Mogoshadi Lodge website.
                    </p>
                </div>
            </div>
        </div>';
        
        return $html;
    }

    public function sendConfirmationEmail($guestEmail, $guestName, $formData)
    {
        try {
            $this->mail->clearAddresses();
            $this->mail->clearReplyTos();
            
            // Recipients
            $this->mail->setFrom($this->config['from_email'], $this->config['from_name']);
            $this->mail->addAddress($guestEmail, $guestName);
            $this->mail->addReplyTo($this->config['reply_to']);

            // Content
            $this->mail->isHTML(true);
            $this->mail->Subject = 'Booking Inquiry Received - Ngoato Mogoshadi Lodge';
            
            $body = $this->generateConfirmationBody($guestName, $formData);
            $this->mail->Body = $body;
            $this->mail->AltBody = strip_tags($body);

            $this->mail->send();
            return true;
            
        } catch (Exception $e) {
            error_log("Confirmation email failed: " . $this->mail->ErrorInfo);
            return false;
        }
    }

    private function generateConfirmationBody($guestName, $data)
    {
        return '
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; background-color: #f8f7f5;">
            <div style="background-color: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <div style="text-align: center; margin-bottom: 30px;">
                    <h1 style="color: #92400e; margin: 0; font-size: 28px;">Thank You!</h1>
                    <div style="width: 50px; height: 3px; background-color: #fbbf24; margin: 10px auto;"></div>
                </div>
                
                <p style="color: #57534e; font-size: 16px; line-height: 1.6;">
                    Dear ' . htmlspecialchars($guestName) . ',
                </p>
                
                <p style="color: #57534e; font-size: 16px; line-height: 1.6;">
                    Thank you for your interest in Ngoato Mogoshadi Lodge. We have received your booking inquiry for:
                </p>
                
                <div style="background-color: #fef3c7; padding: 20px; border-radius: 8px; margin: 20px 0;">
                    <p style="margin: 5px 0; color: #92400e;"><strong>Check-in:</strong> ' . htmlspecialchars($data['checkin']) . '</p>
                    <p style="margin: 5px 0; color: #92400e;"><strong>Check-out:</strong> ' . htmlspecialchars($data['checkout']) . '</p>
                </div>
                
                <p style="color: #57534e; font-size: 16px; line-height: 1.6;">
                    Our team will review your request and get back to you within 24 hours with availability and pricing details.
                </p>
                
                <p style="color: #57534e; font-size: 16px; line-height: 1.6;">
                    If you have any immediate questions, please don\'t hesitate to contact us:
                </p>
                
                <div style="text-align: center; margin: 25px 0;">
                    <p style="margin: 5px 0; color: #44403c;"><strong>Phone:</strong> 082 427 6104</p>
                    <p style="margin: 5px 0; color: #44403c;"><strong>Email:</strong> ngoatomogoshadi7@gmail.com</p>
                </div>
                
                <p style="color: #57534e; font-size: 16px; line-height: 1.6;">
                    We look forward to hosting you!
                </p>
                
                <p style="color: #57534e; font-size: 16px; line-height: 1.6;">
                    Warm regards,<br>
                    <strong>Ngoato Mogoshadi Lodge Team</strong>
                </p>
            </div>
        </div>';
    }
}