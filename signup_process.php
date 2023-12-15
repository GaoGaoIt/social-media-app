
<?php

session_start();

include('config.php');

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\SMTP;

use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";








if (isset($_POST['signup_btn'])) {
    $email_address = $_POST['email'];

    $studentId  = $_POST['studentId'];

    $user_name = userName();
    $full_name = full_name($email_address);

    // echo $user_name ;
    // exit();

    $user_type = "1";

    $facebook = "www.facebook.com";

    $whatsapp = "www.webwhatsapp.com";

    $bio = "tell use more about you";

    $fallowers = 0;

    $fallowing = 0;

    $post_count = 0;

    $image = "default.png";

    $password = randomPassword();

    $domain_validation = 0;

    // $domain_validation = domain_validator($email_address);

    $student_validator = student_id_validator($studentId);

    // domain validation

    if (!$student_validator == '0') {
        // user availibility check in the system

        $sql_query = "SELECT studentId FROM users WHERE studentId = $studentId;";

        $stmt = $conn->prepare($sql_query);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows() > 0) {
            header('location: create-account.php?error_message=Your Email  Account already register on System');

            exit;
        } else {

            $sql_query = "SELECT studentsID FROM students WHERE studentId = $studentId;";

            $stmt = $conn->prepare($sql_query);

            $stmt->execute();

            $stmt->store_result();
            if(!$stmt->num_rows() > 0){

            $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

            $insert_query = "INSERT INTO users (FULL_NAME,USER_NAME,USER_TYPE,PASSWORD_S,EMAIL,IMAGE,FACEBOOK,WHATSAPP,BIO,FALLOWERS,FALLOWING,POSTS, studentId) VALUES

        ('$full_name', '$user_name', '$user_type', '$encrypted_password', '$email_address', '$image', '$facebook', '$whatsapp', '$bio', $fallowers, $fallowing, $post_count, '$studentId');";

            $stmt->prepare($insert_query);

            if ($stmt->execute()) {
                $data_select = "SELECT FULL_NAME,USER_NAME,USER_TYPE,EMAIL,IMAGE,FACEBOOK,WHATSAPP,BIO,FALLOWERS,FALLOWING,POSTS FROM users WHERE USER_NAME = '$user_name';";

                $stmt = $conn->prepare($data_select);

                $stmt->execute();

                $stmt->bind_result($full_name, $user_name, $user_type, $email_address, $image, $facebook, $whatsapp, $bio, $fallowers, $fallowing, $post_count);

                $stmt->fetch();

                //$_SESSION['id'] = $User_ID;

                $_SESSION['username'] = $user_name;

                $_SESSION['fullname'] = $full_name;

                $_SESSION['email'] = $email_address;

                $_SESSION['usertype'] = $user_type;

                $_SESSION['facebook'] = $facebook;

                $_SESSION['whatsapp'] = $whatsapp;

                $_SESSION['bio'] = $bio;

                $_SESSION['fallowers'] = $fallowers;

                $_SESSION['fallowing'] = $fallowing;

                $_SESSION['postcount'] = $post_count;

                $_SESSION['img_path'] = $image;

                $_SESSION['temp_password'] = $password;

                mailer($email_address, $password, $user_name, $full_name);
            }else{
                header('location: create-account.php?error_message=Your Email  Account already register on System');
            }
            } else {

                header("location: create-account.php?error_message=error occurred #008");

                exit;
            }
        }
    } else {
        header("location: create-account.php?error_message=This system does not support external email addresses. Please use the SLTC Mail address that was provided to you");

        exit;
    }
} else {
    header("location: create-account.php?error_message=error occurred #009");

    exit;
}

function userName()
{
    return rand();
}

function full_name($email)
{
    $username = strstr($email, '@', true);

    return $username;
}

function randomPassword()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

    $pass = array();

    $alphaLength = strlen($alphabet) - 1;

    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);

        $pass[] = $alphabet[$n];
    }

    return implode($pass);
}

function domain_validator($email)
{
    $acceptedDomains = array('sltc.ac.lk', 'sltc.lk');

    if (in_array(substr($email, strrpos($email, '@') + 1), $acceptedDomains)) {
        return 1;
    } else {
        return 0;
    }
}

function student_id_validator($studentId)
{
    $acceptedPrefix = 'STU';

    // Remove any non-alphanumeric characters from the student ID
    $cleanedStudentId = preg_replace("/[^a-zA-Z0-9]/", "", $studentId);

    // Check if the cleaned student ID starts with the accepted prefix followed by a dash, year, and number
    $pattern = '/^' . $acceptedPrefix . '-\d{4}-\d{4}$/';

    if (preg_match($pattern, $cleanedStudentId)) {
        return 0;
    } else {
        return 1;
    }
}

function mailer($sending_address, $password, $user_name, $full_name)
{
    $mail = new PHPMailer(true);

    //Enable SMTP debugging.

    $mail->SMTPDebug = 3;

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

    $mail->Subject = "New User Registration";

    $mail->Body = '';
    $mail->Body = file_get_contents('email_template.html');

    // Customize dynamic content
    $mail->Body = str_replace('{USER_NAME}', $user_name, $mail->Body);
    $mail->Body = str_replace('{PASSWORD}', $password, $mail->Body);


    $mail->AltBody = "This is the plain text version of the email content";

    try {
        $mail->send();
        header("location: WelCome.php");

        echo "Message has been sent successfully";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}

?>
