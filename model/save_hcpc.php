<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$id                         = $_POST['mother_id'];

$first_check_up_date        = $conn->real_escape_string($_POST['first_check_up_date']);
$p_weight                   = $conn->real_escape_string($_POST['p_weight']);
$p_height                   = $conn->real_escape_string($_POST['p_height']);
$health_condition           = $conn->real_escape_string($_POST['health_condition']);
$last_mens_period_date      = $conn->real_escape_string($_POST['last_mens_period_date']);
$expected_date_delivery     = $conn->real_escape_string($_POST['expected_date_delivery']);


if (!empty($id)) {
    // Loop through the input arrays
    $query_insert = "INSERT INTO tbl_p_history_and_current_pregnancy_condition (`id_resident`, `first_check_up_date`, `p_weight`, `p_height`, `health_condition`, `last_mens_period_date`, `expected_date_delivery`) 
                    VALUES ('$id', '$first_check_up_date', '$p_weight', '$p_height', '$health_condition', '$last_mens_period_date', '$expected_date_delivery')";
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
