<?php

include('config.php');

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\SMTP;

use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

if(isset($_POST['reset-pass']))
{
    $email_address = $_POST['email'];

    echo $email_address;

    $sql_query = "SELECT User_ID FROM USERS WHERE EMAIL = '$email_address';";

    $stmt = $conn->prepare($sql_query);

    $stmt->execute();

    $stmt->store_result();

    if($stmt->num_rows() > 0)
    {
        require 'config.php';

        $pass = randomPassword();

        $secure_password = md5($pass);

        $SQL_UPDATE = "UPDATE users SET PASSWORD_S = '$secure_password' WHERE EMAIL = '$email_address';";

        $stmt = $conn->prepare($SQL_UPDATE);

        if ($stmt->execute()) {

            $full_name = "College Community User";

            mailer($email_address, $pass, $full_name);

        }
        else{
            header('location: Reset-Password.php?error_message=System Error Try Again');
        }
    }else{
        header('location: Reset-Password.php?error_message=Your E-Mail Not Registered In This Platform');
    }
}


function randomPassword()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

    $pass = array();

    $alphaLength = strlen($alphabet) - 1;

    for ($i = 0; $i < 8; $i++)
    {
        $n = rand(0, $alphaLength);

        $pass[] = $alphabet[$n];
    }

    return implode($pass);
}

function mailer($sending_address, $password, $full_name)
{
    $mail = new PHPMailer(true);

    //Enable SMTP debugging.

    $mail->SMTPDebug = 0;

    //Set PHPMailer to use SMTP.

    $mail->isSMTP();

    //Set SMTP host name

    $mail->Host = "smtp.gmail.com";

    //Set this to true if SMTP host requires authentication to send email

    $mail->SMTPAuth = true;

    //Provide username and password

    $mail->Username = "samchan952@gmail.com";

    $mail->Password = "ovlvwnemcnueijhc";

    //If SMTP requires TLS encryption then set it

    $mail->SMTPSecure = "tls";

    //Set TCP port to connect to

    $mail->Port = 587;

    $mail->From = "samchan952@gmail.com";

    $mail->FromName = "Synergy Community";

    $mail->addAddress($sending_address, $full_name);

    $mail->isHTML(true);

    $mail->Subject = "Change Account Password";

    $mail->Body = '';
    $mail->Body = file_get_contents('reset_pass_template.html');
    $mail->Body = str_replace('{password}', $password, $mail->Body);


    $mail->AltBody = "This is the plain text version of the email content";

    try
    {
        $mail->send();

        // echo "Message has been sent successfully";

        header("location: Reset-Password.php?success_message=New Password Already Sent To Your Email");

    }
    catch (Exception $e)
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}