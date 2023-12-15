<?php
session_start();

include('config.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

if (isset($_POST['signup_btn'])) {
    $email_address = $_POST['email'];
    $studentId = $_POST['studentId'];

    if ($student_validator = student_id_validator($studentId)) {
        if (!$student_validator) {
            if (!user_exists($studentId)) {
                $password = randomPassword();
                $result = create_user($email_address, $studentId, $password);

                if ($result) {
                    mailer($email_address, $password, $result['user_name'], $result['full_name']);
                    header("location: WelCome.php");
                    exit;
                } else {
                    header('location: create-account.php?error_message=Error occurred during user creation');
                    exit;
                }
            } else {
                header('location: create-account.php?error_message=Email account already registered on the system');
                exit;
            }
        } else {
            header("location: create-account.php?error_message=Invalid student ID");
            exit;
        }
    } else {
        header("location: create-account.php?error_message=This system does not support external email addresses. Please use the SLTC Mail address that was provided to you");
        exit;
    }
} else {
    header("location: create-account.php?error_message=Error occurred #009");
    exit;
}

function user_exists($studentId)
{
    global $conn;
    $sql_query = "SELECT studentId FROM users WHERE studentId = ?;";
    $stmt = $conn->prepare($sql_query);
    $stmt->bind_param('s', $studentId);
    $stmt->execute();
    $stmt->store_result();
    return $stmt->num_rows() > 0;
}

function create_user($email_address, $studentId, $password)
{
    global $conn;
    $user_name = userName();
    $full_name = full_name($email_address);
    $user_type = "1";
    $facebook = "www.facebook.com";
    $whatsapp = "www.webwhatsapp.com";
    $bio = "tell use more about you";
    $fallowers = 0;
    $fallowing = 0;
    $post_count = 0;
    $image = "default.png";
    $domain_validation = 0;

    $sql_query = "INSERT INTO users (FULL_NAME,USER_NAME,USER_TYPE,PASSWORD_S,EMAIL,IMAGE,FACEBOOK,WHATSAPP,BIO,FALLOWERS,FALLOWING,POSTS, studentId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    
    $stmt = $conn->prepare($sql_query);
    $stmt->bind_param('sssssssssiiss', $full_name, $user_name, $user_type, password_hash($password, PASSWORD_DEFAULT), $email_address, $image, $facebook, $whatsapp, $bio, $fallowers, $fallowing, $post_count, $studentId);

    if ($stmt->execute()) {
        $data_select = "SELECT FULL_NAME,USER_NAME,USER_TYPE,EMAIL,IMAGE,FACEBOOK,WHATSAPP,BIO,FALLOWERS,FALLOWING,POSTS FROM users WHERE USER_NAME = ?;";
        $stmt = $conn->prepare($data_select);
        $stmt->bind_param('s', $user_name);
        $stmt->execute();
        $stmt->bind_result($full_name, $user_name, $user_type, $email_address, $image, $facebook, $whatsapp, $bio, $fallowers, $fallowing, $post_count);
        $stmt->fetch();
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
        return compact('user_name', 'full_name');
    } else {
        return false;
    }
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
    $cleanedStudentId = preg_replace("/[^a-zA-Z0-9]/", "", $studentId);
    $pattern = '/^' . $acceptedPrefix . '-\d{4}-\d{4}$/';
    if (preg_match($pattern, $cleanedStudentId)) {
        return 1; // Valid student ID
    } else {
        return 0; // Invalid student ID
    }
}




function mailer($sending_address, $password, $user_name, $full_name)
{
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 3;
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "samchan952@gmail.com";
    $mail->Password = "ovlvwnemcnueijhc";
    $mail->SMTPSecure = "tls";
    $mail->Port = 587;
    $mail->From = "samchan952@gmail.com";
    $mail->FromName = "Synergy Community";
    $mail->addAddress($sending_address, $full_name);
    $mail->isHTML(true);
    $mail->Subject = "New User Registration";
    $mail->Body = file_get_contents('email_template.html');
    $mail->Body = str_replace('{USER_NAME}', $user_name, $mail->Body);
    $mail->Body = str_replace('{PASSWORD}', $password, $mail->Body);
    $mail->AltBody = "This is the plain text version of the email content";

    try {
        $mail->send();
        echo "Message has been sent successfully";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}

