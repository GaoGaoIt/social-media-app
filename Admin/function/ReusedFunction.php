<?php
include '../config.php';

function checkUserIsAdmin()
{
    // Check if the user is logged in
    if (!isset($_SESSION['id'])) {
        header('location: login.php');
        exit;
    }

    // Check if the user is an admin
    $userType = $_SESSION['usertype'];
    if ($userType === '1') {
        header('location: ../home.php');
        exit;
    }

    // User is not an admin
    return false;
}
function fetchAllData()
{
    global $conn;

    $query = "SELECT * 
            FROM pivot_content_data";

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        mysqli_stmt_close($stmt);

        return $result;
    } else {
        echo "Error: " . mysqli_error($conn);
        return null; // Return null in case of an error
    }
}
function fetchUserName($userId)
{
    global $conn;

    $query = "SELECT USER_NAME FROM Users WHERE User_ID = ?";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "i", $userId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);


    if ($result) {

        $user = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

        return $user ? $user['USER_NAME'] : null;
    } else {
        echo "Error: " . mysqli_error($conn);
        return null;
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
function fetchUserAvatar($userId)
{
    global $conn;

    $query = "SELECT IMAGE FROM Users WHERE User_ID = ?";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "i", $userId);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);


    if ($result) {

        $user = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

        return $user ? $user['IMAGE'] : null;
    } else {
        echo "Error: " . mysqli_error($conn);
        return null;
    }
}
function  fetchUserId($username)
{
    global $conn;

    $query = "SELECT User_ID FROM Users WHERE User_Name = ?";

    $stmt = mysqli_prepare($conn, $query);

    mysqli_stmt_bind_param($stmt, "s", $username);

    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);


    if ($result) {

        $user = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

        return $user ? $user['User_ID'] : null;
    } else {
        echo "Error: " . mysqli_error($conn);
        return null;
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}
function postCount($typeName)
{
    global $conn;  // Assuming you have a global database connection object

    $query = "SELECT COUNT(*) as count FROM pivot_content_data WHERE type = ?";


    $stmt = mysqli_prepare($conn, $query);


    if ($stmt) {


        mysqli_stmt_bind_param($stmt, "s", $typeName);

        mysqli_stmt_execute($stmt);


        $result = mysqli_stmt_get_result($stmt);


        if ($result) {

            $count = mysqli_fetch_assoc($result)['count'];

            mysqli_free_result($result);

            mysqli_stmt_close($stmt);

            return $count;
        } else {

            echo "Error: " . mysqli_error($conn);
        }
    } else {

        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement (in case of an error)
    mysqli_stmt_close($stmt);

    return null;
}

function studentCount()
{
    global $conn;  // Assuming you have a global database connection object

    $query = "SELECT COUNT(*) as count FROM users where USER_TYPE  = 1";


    $stmt = mysqli_prepare($conn, $query);


    if ($stmt) {



        mysqli_stmt_execute($stmt);


        $result = mysqli_stmt_get_result($stmt);


        if ($result) {

            $count = mysqli_fetch_assoc($result)['count'];

            mysqli_free_result($result);

            mysqli_stmt_close($stmt);

            return $count;
        } else {

            echo "Error: " . mysqli_error($conn);
        }
    } else {

        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement (in case of an error)
    mysqli_stmt_close($stmt);

    return null;
};


function fetchPostsData()
{
    global $conn;

    $query = "SELECT * 
            FROM pivot_content_data
            WHERE type = 'posts' AND user_type = 1";

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        mysqli_stmt_close($stmt);

        return $result;
    } else {
        echo "Error: " . mysqli_error($conn);
        return null; // Return null in case of an error
    }
}
function fetchEventsData()
{
    global $conn;

    $query = "SELECT * 
            FROM pivot_content_data
            WHERE type = 'events' AND user_type = 1";

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        mysqli_stmt_close($stmt);

        return $result;
    } else {
        echo "Error: " . mysqli_error($conn);
        return null; // Return null in case of an error
    }
}
function fetchVideosData()
{
    global $conn;

    $query = "SELECT * 
            FROM pivot_content_data
            WHERE type = 'videos' AND user_type = 1";

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        mysqli_stmt_close($stmt);

        return $result;
    } else {
        echo "Error: " . mysqli_error($conn);
        return null; // Return null in case of an error
    }
}

function alertToast($type, $message)
{

    if ($type !== null && $message !== null) {
        echo '<script src="plugins/sweetalert2/sweetalert2.all.js"></script>';
        echo '<script src="dist/js/sweetAlert.js"></script>';
        echo '<script>';
        echo '    document.addEventListener("DOMContentLoaded", function() {';
        echo '        if (' . json_encode($type) . ') {';
        echo '            alertSuccessToast("' . $message . '", document.body);';
        echo '        } else {';
        echo '            alertErrorToast("' . $message . '", document.body);';
        echo '        }';
        echo '    });';
        echo '</script>';
    }
}
function EditData($dataId)
{
    global $conn;
    checkUserIsAdmin();


    $query = "SELECT * 
            FROM pivot_content_data where content_id = $dataId";

    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        mysqli_stmt_close($stmt);

        return $result;
    } else {
        echo "Error: " . mysqli_error($conn);
        return null; // Return null in case of an error
    }
}

function softDelete($dataId)
{
    global $conn;
    $checkQuery = "SELECT is_deleted, status FROM pivot_content_data WHERE content_id = ?";
    $checkStmt = mysqli_prepare($conn, $checkQuery);

    if ($checkStmt) {
        mysqli_stmt_bind_param($checkStmt, "i", $dataId);
        mysqli_stmt_execute($checkStmt);
        mysqli_stmt_store_result($checkStmt);
        mysqli_stmt_bind_result($checkStmt, $isDeleted, $status);

        if (mysqli_stmt_fetch($checkStmt)) {
            $newIsDeleted = $isDeleted == 0 ? 1 : 0;

            // Check if the current status is "PUBLISH" or "BLOCK" before updating
            $newStatus = $status == 'PUBLISH' ? 'BLOCK' : 'PUBLISH';

            $updateQuery = "UPDATE pivot_content_data SET is_deleted = ?, status = ? WHERE content_id = ?";
            $updateStmt = mysqli_prepare($conn, $updateQuery);

            if ($updateStmt) {
                mysqli_stmt_bind_param($updateStmt, "isi", $newIsDeleted, $newStatus, $dataId);
                $success = mysqli_stmt_execute($updateStmt);

                if ($success) {
                    mysqli_stmt_close($updateStmt);
                    mysqli_stmt_free_result($checkStmt);
                    mysqli_stmt_close($checkStmt);

                    alertToast(true, 'Updating Successfully');
                } else {
                    $error = "Error updating record: " . mysqli_stmt_error($updateStmt);
                    mysqli_stmt_close($updateStmt);
                    return $error;
                }
            } else {
                $error = "Error preparing update statement: " . mysqli_error($conn);
                return $error;
            }
        } else {
            echo "No record found for the given ID.";
            alertToast(false, "Record not found for the given ID.");
        }
    } else {
        $error = "Error checking record: " . mysqli_error($conn);
        return $error;
    }
}

function update_Posts($user_id)
{
    global $conn;

    $insert_query = "UPDATE users SET POSTS = POSTS+1 WHERE User_ID = $user_id ;";

    $stmt = $conn->prepare($insert_query);

    if ($stmt->execute()) {

        $_SESSION['postcount'] = $_SESSION['postcount'] + 1;
    }
}
function UpdateData($ID, $file_complete, $caption, $hashtags, $tempFileName, $type)
{
    global $conn;

    // echo $type;
    // exit();
    $sql_query = "UPDATE pivot_content_data SET content_path_name = ?, Caption = ?, HashTags = ? WHERE content_id = ?";

    $stmt = $conn->prepare($sql_query);


    if (!$stmt) {
        die("Error in preparing the statement: " . $conn->error);
    }


    $stmt->bind_param("sssi", $file_complete, $caption, $hashtags, $ID);


    if ($stmt->execute()) {




        $basePath = ($type == "videos") ? "../assets/videos/" : "../assets/images/posts/";
        


        // Set the folder path
        $folder = $basePath . $file_complete;

        // echo $folder;
        // exit();

        // Check if the directory exists, create it if not
        if (!is_dir($basePath)) {
            mkdir($basePath, 0755, true);
        }




        if (move_uploaded_file($tempFileName, $folder)) {

            session_start();


            
            $redirectUrl = ($_SESSION['usertype'] != '0') ? "../post-uploader.php" : "index.php";
            header("location: $redirectUrl?type=true&message=Post Successfully updated");

            update_Posts($ID);


            exit;
        } else {

            header("location: ../post-uploader.php?error_message=Error uploading file");
            exit;
        }
    } else {

        header("location: ../post-uploader.php?error_message=Error Occurred, try again - ERROR #008");
        exit;
    }
}
