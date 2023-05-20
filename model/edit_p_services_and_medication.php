<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$med_or_services_name     = $conn->real_escape_string($_POST['med_or_services_name']);
$ms_id                    = $conn->real_escape_string($_POST['ms_id']);

if (!empty($med_or_services_name)) {

    $update  = "UPDATE tbl_p_medication_and_other_services
                SET med_or_services_name = '$med_or_services_name'
                WHERE id_med_other_services = '$ms_id '";
    $result  = $conn->query($update);

    if ($result === true) {
        $_SESSION['message'] = 'Record updated!';
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
