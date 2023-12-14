<?php

include 'function/ReusedFunction.php';

$editData = isset($_GET['EditData']) ? $_GET['EditData'] : null;
$deleteData = isset($_GET['delateData']) ? $_GET['delateData'] : null;

$updateContent = isset($_GET['specialContent']) ? $_GET['specialContent'] : null;


$_SESSION['previous_location'] = $_SERVER['HTTP_REFERER'];


if ($editData) {
    header("location: EditData.php?data={$editData}");
    exit();
} elseif ($deleteData) {
    softDelete($deleteData);
    header("Location: {$_SESSION['previous_location']}?type=true&message=Successfully update");
    exit();
}

if($updateContent){
    updateEventType($updateContent);
    header("Location: {$_SESSION['previous_location']}?type=true&message=Successfully update");
}




if (isset($_POST['updateData'])) {

    if ($_POST['type'] == 'posts' || $_POST['type'] == 'events') {

        if (isset($_POST['dataId'], $_POST['type'], $_POST['caption'], $_POST['hash-tags'], $_FILES['image']['name'], $_FILES['image']['tmp_name'])) {
            // Sanitize and validate inputs
            $dataId = (int)$_POST['dataId'];
            $caption = htmlspecialchars($_POST['caption']);
            $hashtags = htmlspecialchars($_POST['hash-tags']);
            $fileName = $_FILES['image']['name'];
            $tempFileName = $_FILES['image']['tmp_name'];

            // Generate a unique file name
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $randomNum = rand(0, 1000000);
            $fileRename = 'File_' . date('Ymd') . $randomNum;
            $file_complete = $fileRename . '.' . $fileExtension;

            $type = $_POST['type'];

            // // Call the UpdateData function
            UpdateData($dataId, $file_complete, $caption, $hashtags, $tempFileName, $type);
        }
    } elseif ($_POST['type'] == 'videos') {

        $filename = $_FILES["file"]["name"];
        $tempFileName = $_FILES["file"]["tmp_name"];

        $filename_thumb = $_FILES["thumbnail"]["name"];
        $thumb_temp_name = $_FILES["thumbnail"]["tmp_name"];

        $file_type = pathinfo($filename_thumb, PATHINFO_EXTENSION);
        $file_extansion = pathinfo($filename, PATHINFO_EXTENSION);

        $random_number = rand(0, 10000000);

        $file_rename = 'Vid_' . date('Ymd') . $random_number;
        $file_complete = $file_rename . '.' . $file_extansion;

        $thumbnail_name = 'Thumb_' . date('Ymd') . $random_number;
        $thumbnail_name_complete = $thumbnail_name . '.' . $file_type;

        $second_file = "./assets/videos/" . $thumbnail_name_complete;

        $dataId = (int)$_POST['dataId'];
        $caption = $_POST['caption'];
        $hashtags = $_POST['hash-tags'];
        $type = $_POST['type'];

        UpdateData($dataId, $file_complete, $caption, $hashtags, $tempFileName, $type);
    }
}


if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $studentIc = $_POST['ic'];
    $course = $_POST['course'];
    $teacher = $_POST['teacher'];
    $gender = $_POST['gender'];
    $intake = $_POST['intake'];

    if (!createStudentProfile($name, $course, $teacher, $studentIc, $gender, $intake)) {
        header('Location: index.php?success&message=Successful%20Create%20student');
    } else {
        header('location: createStudent.php?error');
    }
}

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $studentIc = $_POST['ic'];
    $course = $_POST['course'];
    $teacher = $_POST['teacher'];
    $gender = $_POST['gender'];
    $intake = $_POST['intake'];
    $id = $_POST['stuID'];

    if (!updateStudentProfile($name, $course, $teacher, $studentIc, $gender, $intake, $id)) {
        header('Location: students.php?success&message=Successful%20Update%20student');
    } else {
        header('location: createStudent.php?error');
    }
}


