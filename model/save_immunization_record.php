<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$id      = $_POST['mother_id'];

$hcpc_id        = $conn->real_escape_string($_POST['hcpc_id']);
$tcv            = $conn->real_escape_string($_POST['tcv']);
$date_given     = $conn->real_escape_string($_POST['date_given']);
$when_to_return = $conn->real_escape_string($_POST['when_to_return']);

if (!empty($id)) {
    // Loop through the input arrays
    $query_insert = "INSERT INTO tbl_p_immunization_record (`id_mother_h_c_pregnancy_condition`, `tetanus_containing_vaccine`, `date_given`, `when_to_return`) 
                    VALUES ('$hcpc_id', '$tcv', '$date_given', '$when_to_return')";
    $result_insert = $conn->query($query_insert);

    if ($result_insert) {
        $_SESSION['message'] = 'Added successfully!';
        $_SESSION['success'] = 'success';
    }
} else {
    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['success'] = 'danger';
}

header("Location: ../pregnant_women_profile_view.php?id=" . urlencode($id));

$conn->close();
