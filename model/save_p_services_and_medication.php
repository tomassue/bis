<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$med_or_services_name     = $conn->real_escape_string($_POST['med_or_services_name']);

if (!empty($med_or_services_name)) {

    $insert  = "INSERT INTO tbl_p_medication_and_other_services (`med_or_services_name`) VALUES ('$med_or_services_name')";
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

header("Location: ../p_services_and_medication.php");

$conn->close();
