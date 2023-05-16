<?php
include '../server/server.php';

if (!isset($_SESSION['username']) && $_SESSION['role'] != 'administrator') {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$mother_id        =   $_GET['mother_id'];
$child_id         =   $_GET['child_id'];

if ($child_id != '' && $mother_id != '') {
    $query      = "DELETE FROM tbl_p_fam_members WHERE `id_resident` = '$child_id'";
    $result     = $conn->query($query);

    if ($result === true) {
        $_SESSION['message'] = 'Child info has been removed!';
        $_SESSION['success'] = 'success';
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
