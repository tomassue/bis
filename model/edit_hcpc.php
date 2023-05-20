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
    $query_update = "UPDATE tbl_p_history_and_current_pregnancy_condition
                    SET first_check_up_date = '$first_check_up_date', p_weight = '$p_weight', p_height = '$p_height', health_condition = '$health_condition', last_mens_period_date = '$last_mens_period_date', expected_date_delivery = '$expected_date_delivery'
                    WHERE id_resident = '$id'";
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
