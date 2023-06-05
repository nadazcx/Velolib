<?php
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;
require_once('PHPMailer/src/Exception.php');
require_once('PHPMailer/src/PHPMailer.php');
require_once('PHPMailer/src/SMTP.php');

// if (isset($_POST['submit'])) {
    $name = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
    $subject = $_POST['subject'];
    $message = htmlentities($_POST['message']);
    
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'baskaltitunis@gmail.com';
    $mail->Password = 'wwbxyskgvulpahnj';
    $mail->Port = 465;
    $mail->SMTPSecure = 'ssl';
    $mail->isHTML(true);
    $mail->setFrom($email, $name);
    $mail->addAddress('baskaltitunis@gmail.com');
    $mail->Subject = "$email($subject)";
    $mail->Body = $message;
    $mail->send();
    echo("Sent Sucessfully ");

    header("Location: ../index.html#contact");
    exit();
// } else {
//     echo "Erreur: Submit button not set.";
// }
?>
