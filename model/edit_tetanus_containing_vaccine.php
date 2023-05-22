<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$tetanus_containing_vaccine_detail     = $conn->real_escape_string($_POST['tetanus_containing_vaccine_detail']);
$tetanus_vac_id                        = $conn->real_escape_string($_POST['tetanus_vac_id']);

if (!empty($tetanus_containing_vaccine_detail) && !empty($tetanus_vac_id)) {

    $update  = "UPDATE tbl_p_tetanus_vaccine
                SET tetanus_containing_vaccine_detail = '$tetanus_containing_vaccine_detail'
                WHERE tetanus_containing_vaccine = '$tetanus_vac_id'";
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

header("Location: ../p_tetanus_containing_vaccine.php");

$conn->close();
