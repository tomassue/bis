<?php
include '../server/server.php';

if (!isset($_SESSION['username']) && $_SESSION['role'] != 'administrator') {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$mother_id        =   $_GET['mother_id'];
$em_id            =   $_GET['em_id'];

if ($em_id != '' && $mother_id != '') {
    $query      = "DELETE FROM tbl_p_emergency_contact WHERE `id_p_emergency_contact` = '$em_id'";
    $result     = $conn->query($query);

    if ($result === true) {
        $_SESSION['message'] = 'Emergency contact has been removed!';
        $_SESSION['success'] = 'danger';
    } else {
        $_SESSION['message'] = 'Something went wrong!';
        $_SESSION['success'] = 'danger';
    }
} else {

    $_SESSION['message'] = 'Missing ID!';
    $_SESSION['success'] = 'danger';
}

header("Location: ../pregnant_women_profile_view.php?id=" . urlencode($mother_id));

$conn->close();
