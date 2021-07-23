<?php

    // allow for demo mode testing of emails
    define("DEMO", true);
	function mailing($template_file, $swap_var){ $email_from = '';
        $email_headers = "From: ".$email_from."\r\nReply-To: ".$email_from."\r\n";
        $email_headers .= "MIME-Version: 1.0\r\n";
        $email_headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

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

        // send the email out to the user
        mail($email_to, $email_subject, $email_message, $email_headers);
    }

?>