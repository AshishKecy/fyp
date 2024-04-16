<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//required files
require '../mail/phpmailer/src/Exception.php';
require '../mail/phpmailer/src/PHPMailer.php';
require '../mail/phpmailer/src/SMTP.php';

// Create an instance; passing `true` enables exceptions
if (isset($_POST["send"])) {

  // Get the sender's email address from the form
  $senderEmail = $_POST["email"];

  $mail = new PHPMailer(true);

  // Server settings
  $mail->isSMTP();                              // Send using SMTP
  $mail->Host = 'smtp.gmail.com';               // Set the SMTP server to send through
  $mail->SMTPAuth = true;                       // Enable SMTP authentication
  $mail->Username = 'bkr5668@gmail.com';        // SMTP email address
  $mail->Password = 'idqpdakgqrytywdh';         // SMTP password
  $mail->SMTPSecure = 'ssl';                    // Enable implicit SSL encryption
  $mail->Port = 465;

  // Recipients
  $mail->setFrom($senderEmail, $_POST["name"]); // Sender Email and name
  $mail->addAddress('bkr5668@gmail.com');       // Add a recipient email  
  $mail->addReplyTo($senderEmail, $_POST["name"]); // Reply to sender email

  // Content
  $mail->isHTML(true);                          // Set email format to HTML
  $mail->Subject = $_POST["subject"];           // Email subject headings
  $mail->Body = $_POST["message"];              // Email message

  // Send the email
  $mail->send();

  // Success sent message alert
  echo "
  <script> 
      alert('Message was sent successfully!');
      document.location.href = 'index.php';
  </script>
  ";
}

?>