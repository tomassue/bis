<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$honorifics        = $conn->real_escape_string($_POST['honorifics']);
$name              = $conn->real_escape_string($_POST['name']);
// $chair        = $conn->real_escape_string($_POST['chair']);
$chairmanship      = $_POST['chairmanship'];
$pos               = $conn->real_escape_string($_POST['position']);
$start             = $conn->real_escape_string($_POST['start']);
$end               = $conn->real_escape_string($_POST['end']);
$status            = $conn->real_escape_string($_POST['status']);

if (!empty($honorifics) && !empty($name) && !empty($chairmanship) && !empty($pos) && !empty($start) && !empty($end) && !empty($status)) {
    //INSERT OFFICIAL
    $insert  = "INSERT INTO tblofficials (`honorifics`,`name`, `id_position`, termstart, termend, `status`) VALUES ('$honorifics','$name','$pos', '$start','$end', '$status')";
    $result  = $conn->query($insert);
    $last_id_official_inserted = mysqli_insert_id($conn);

    //INSERT THE ID OF THE LAST OFFICIAL INSERTED
    foreach ($chairmanship as $chair) {
        $insert_query_chairmanship = "INSERT INTO tblofficials_chairmanships (`id_officials`, `id_chairmanship`) VALUES ('$last_id_official_inserted', '$chair')";
        $result_query_chairmanship = $conn->query($insert_query_chairmanship);
    }

    if ($result === true) {
        $_SESSION['message'] = 'Official added!';
        $_SESSION['success'] = 'success';
    } else {
        $_SESSION['message'] = 'Something went wrong!';
        $_SESSION['success'] = 'danger';
    }
} else {

    $_SESSION['message'] = 'Please fill up the form completely!';
    $_SESSION['success'] = 'danger';
}

header("Location: ../officials.php");

$conn->close();
