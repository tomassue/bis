<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$tetanus_containing_vaccine_detail     = $conn->real_escape_string($_POST['tetanus_containing_vaccine_detail']);

if (!empty($tetanus_containing_vaccine_detail)) {

    $insert  = "INSERT INTO tbl_p_tetanus_vaccine (`tetanus_containing_vaccine_detail`) VALUES ('$tetanus_containing_vaccine_detail')";
    $result  = $conn->query($insert);

    if ($result === true) {
        $_SESSION['message'] = 'Record added!';
        $_SESSION['success'] = 'success';
    } else {
        $_SESSION['message'] = 'Something went wrong!';
        $_SESSION['success'] = 'danger';
    }
} else {

    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['success'] = 'danger';
}

header("Location: ../p_tetanus_containing_vaccine.php");

$conn->close();
