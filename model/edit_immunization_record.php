<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$id                            = $_POST['mother_id'];

$id_immunization_record        = $conn->real_escape_string($_POST['id_immunization_record']);
$tcv                           = $conn->real_escape_string($_POST['tcv']);
$date_given                    = $conn->real_escape_string($_POST['date_given']);
$when_to_return                = $conn->real_escape_string($_POST['when_to_return']);

if (!empty($id)) {
    // Loop through the input arrays
    $query_update = "UPDATE tbl_p_immunization_record
                    SET tetanus_containing_vaccine = '$tcv', date_given = '$date_given', when_to_return = '$when_to_return'
                    WHERE id_immunization_record = '$id_immunization_record'";
    $result_update = $conn->query($query_update);

    if ($result_update) {
        $_SESSION['message'] = 'Edited successfully!';
        $_SESSION['success'] = 'success';
    }
} else {
    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['success'] = 'danger';
}

header("Location: ../pregnant_women_profile_view.php?id=" . urlencode($id));

$conn->close();
