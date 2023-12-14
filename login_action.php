<?php

session_start();

include('config.php');

if (isset($_POST['button'])) {
    $userInput = $_POST['email'];
    $passwordInput = $_POST['password'];

    $sql_query = "SELECT User_ID, FULL_NAME, USER_NAME, USER_TYPE, EMAIL, IMAGE, FACEBOOK, WHATSAPP, BIO, FALLOWERS, FALLOWING, POSTS, PASSWORD_S FROM users WHERE (USER_NAME = ? OR EMAIL = ? or studentId = ?);";

    $stmt = $conn->prepare($sql_query);
    $stmt->bind_param("sss", $userInput, $userInput, $userInput);

    $stmt->execute();

    $stmt->store_result();

    if ($stmt->num_rows() > 0) {
        $stmt->bind_result($user_id, $full_name, $user_name, $user_type, $email_address, $image, $facebook, $whatsapp, $bio, $fallowers, $fallowing, $post_count, $storedPassword);

        $stmt->fetch();

        // Verify the hashed password
        if (password_verify($passwordInput, $storedPassword)) {
            $_SESSION['id'] = $user_id;
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

            if ($user_type == 0) {
                header("location: ./Admin/index.php");
            } else {
                header("location: home.php");
            }
        } else {
            // Password verification failed
            header('location: login.php?error_message=Email/Password Incorrect');
            exit;
        }
    } else {
        // User not found
        header('location: login.php?error_message=Email/Password Incorrect');
        exit;
    }
} else {
    // No form submission
    header('location: login.php?error_message=Some Error Happened');
    exit;
}

?>
