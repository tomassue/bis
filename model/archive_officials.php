<?php
include '../server/server.php';

if (!isset($_SESSION['username']) && $_SESSION['role'] != 'administrator') {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$archive      = $conn->real_escape_string('1');

$query_count_officials = "SELECT * FROM tblofficials WHERE `archive`='0'";
$result_count_officials = $conn->query($query_count_officials);
$count_officials = $result_count_officials->num_rows;

if ($archive != '' && $count_officials > 0) {
    //We will be updating all of the records archive to 1; to have them updated and insert a concatenated termstart and termend to archive_term. This will serve as our indicator for the list.
    $query_archive_officials = "UPDATE tblofficials 
                                SET `archive` = '$archive'";
    $result_archive_officials = $conn->query($query_archive_officials);
    if ($result_archive_officials === true) {
        $_SESSION['message'] = 'Archived successfully!';
        $_SESSION['success'] = 'success';
    } else {
        $_SESSION['message'] = 'Something went wrong!';
        $_SESSION['success'] = 'danger';
    }
} else {
    $_SESSION['message'] = 'No record to archive!';
    $_SESSION['success'] = 'danger';
}

header("Location: ../officials.php");
$conn->close();
