<?php
// Include PHPMailer files
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

// Include config file
require 'config.php';

// Create a new PHPMailer instance
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.hostinger.com';  // Hostinger SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = $config['email'];      // Your email
    $mail->Password   = $config['password'];   // Your password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  // Enable SSL encryption
    $mail->Port       = 465;                  // Hostinger SMTP port for SSL
    
    // Enable debug output for troubleshooting
    $mail->SMTPDebug = 2;                    // Enable verbose debug output
    $mail->Debugoutput = 'error_log';        // Write to error log

    // Get form data
    $firstName = $_POST['firstName'] ?? '';
    $lastName  = $_POST['lastName'] ?? '';
    $email     = $_POST['email'] ?? '';
    $phone     = $_POST['phone'] ?? '';
    $subject   = $_POST['subject'] ?? '';
    $message   = $_POST['message'] ?? '';

    // Recipients
    $mail->setFrom('info@firmgripsecurityconsult.com', 'Firm Grip Security Contact Form');  // Use your Hostinger email
    $mail->addReplyTo($email, "$firstName $lastName");  // Set reply-to as the sender's email
    $mail->addAddress('info@firmgripsecurityconsult.com', 'Firm Grip Security Consult');

    // Content
    $mail->Subject = "Contact Form: $subject";
    $mail->Body    = "Contact Form Submission\n\n".
                     "Name: $firstName $lastName\n".
                     "Email: $email\n".
                     "Phone: $phone\n\n".
                     "Message:\n$message";

    // Send email
    $mail->send();
    
    // Return success response
    header('Content-Type: application/json');
    echo json_encode(['status' => 'success', 'message' => 'Message sent successfully']);
} catch (Exception $e) {
    // Return error response
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
}
