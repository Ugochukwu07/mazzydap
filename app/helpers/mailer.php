<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function mailing($template_file, $swap_var){
    // Load Composer's autoloader
    require 'vendor/autoload.php';
    
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
try{

        // load the email to and subject from the $swap_var
        $email_to = $swap_var['{TO_EMAIL}'];
        $email_subject = $swap_var['{EMAIL_TITLE}']; // you can add time() to get unique subjects for testing: time();

        // load in the template file for processing (after we make sure it exists)
        if (file_exists($template_file)) {
            $email_message = file_get_contents($template_file);
        } else {
            die("Unable to locate your template file");
        }

        // search and replace for predefined variables, like SITE_ADDR, {NAME}, {lOGO}, {CUSTOM_URL} etc
        foreach (array_keys($swap_var) as $key) {
            if (strlen($key) > 2 && trim($swap_var[$key]) != '') {
                $email_message = str_replace($key, $swap_var[$key], $email_message);
            }
        }

        // check if the email script is in demo mode, if it is then dont actually send an email
        if (DEMO) {
        // display the email template back to the user for final approval
        echo $email_message;
            die("<hr /><center>This is a demo of the HTML email to be sent. No email was sent. </center>");
        }

        //Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = MHOST;                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = MUSER;                     // SMTP username
        $mail->Password   = MPASS;                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_STARTTLS` encouraged
        $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_STARTTLS` above
    
        //Recipients
        $mail->setFrom(MUSER, MFROM);
        $mail->addAddress($email_to, $swap_var['#name#']);
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $email_subject;
        $mail->Body    = $email_message;
        
        if(DEMO){
            echo $email_message;
        }else{
            $mail->send();
        }
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}