<?php
require("../PHPMailer_5.2.0/class.PHPMailer.php");

class Email{
    public function send($name, $email, $phone, $message){

        $mail = new PHPMailer();
        $mail->IsSMTP();                                      // set mailer to use SMTP
        $mail->Host = "mail.nils-photography.com";  // specify main and backup server
        $mail->SMTPAuth = true;     // turn on SMTP authentication
        $mail->Username = "noreply@nils-photography.com";  // SMTP username
        $mail->Password = "Antaheen@4813"; // SMTP password
        $mail->From = "noreply@nils-photography.com";
        $mail->FromName = "Nils Photography <noreply@nils-photography.com>";
        $mail->AddAddress($email);           
        $mail->AddReplyTo("contactus@nils-photography.com", "Information");
        $mail->IsHTML(true);  
        $mail->Subject = "Query about Nils Photography";
        $email_template_string = file_get_contents('email_template.html', true);
        $email_template_string = str_replace("@firstName@", $name, $email_template_string);
        $email_template_string = str_replace("@message@", $message, $email_template_string);
        $mail->Body    = $email_template_string;
        if(!$mail->Send())
        {
            echo "Message could not be sent.";
            echo "Mailer Error: " . $mail->ErrorInfo;
            exit;
        }else{
            echo "We received your message";
        }

        


        // $from = "noreply@nils-photography.com"; // this is the sender's Email address
        // $reply = "info@nils-photography.com";
        // $fromName="Nils Photography <noreply@nils-photography.com>";
        // $subject = "Query about Nils Photography";
        // $subject_cc = "Query about Nils Photography::Contact Number->".$phone;
        
        // $headers = 'MIME-Version: 1.0' . "\r\n";
        // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";        $headers .= 'From:  ' . $fromName . " \r\n" .
        //         'Reply-To: '.  $reply . "\r\n" .
        //         'X-Mailer: PHP/' . phpversion();
        // mail($email,$subject,$email_template_string,$headers, "-f noreply@nils-photography.com");
        // mail($reply,$subject_cc,$email_template_string,$headers, "-f noreply@nils-photography.com");
    }
}
?>