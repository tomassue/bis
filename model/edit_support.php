<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$status_support     = $conn->real_escape_string($_POST['status_support']);
$id_support         = $conn->real_escape_string($_POST['id_support']);

if (!empty($status_support)) {

    $query      = "UPDATE tbl_support SET `status_support` = '$status_support' WHERE id_support=$id_support;";
    $result     = $conn->query($query);

    if ($result === true) {
        $_SESSION['message'] = 'Support has been updated!';
        $_SESSION['success'] = 'success';
    } else {
        $_SESSION['message'] = 'Something went wrong!';
        $_SESSION['success'] = 'danger';
    }
} else {

    $_SESSION['message'] = 'No Support ID found!';
    $_SESSION['success'] = 'danger';
}

header("Location: ../support.php");

$conn->close();
