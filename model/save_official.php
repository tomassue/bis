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
$archive           = $conn->real_escape_string('0');

$query_check_duplicate_official_name = "SELECT * FROM tblofficials WHERE `archive` = '0' AND `name` = '$name'";
$result_check_duplicate_official_name = $conn->query($query_check_duplicate_official_name)->num_rows;

if ($result_check_duplicate_official_name == 0) {
    if (!empty($honorifics) && !empty($name) && !empty($pos) && !empty($start) && !empty($end) && !empty($status)) {
        //INSERT OFFICIAL
        $insert  = "INSERT INTO tblofficials (`honorifics`,`name`, `id_position`, termstart, termend, `status`, `archive`) VALUES ('$honorifics','$name','$pos', '$start','$end', '$status', '$archive')";
        $result  = $conn->query($insert);
        $last_id_official_inserted = mysqli_insert_id($conn);

        //INSERT THE ID OF THE LAST OFFICIAL INSERTED
        //It has to be inside of a foreach loop because we want to insert the chairmanships in a separate records.
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
} else {
    $_SESSION['message'] = 'The name is already existing!';
    $_SESSION['success'] = 'danger';
}

// if (!empty($honorifics) && !empty($name) && !empty($pos) && !empty($start) && !empty($end) && !empty($status)) {
//     //INSERT OFFICIAL
//     $insert  = "INSERT INTO tblofficials (`honorifics`,`name`, `id_position`, termstart, termend, `status`, `archive`) VALUES ('$honorifics','$name','$pos', '$start','$end', '$status', '$archive')";
//     $result  = $conn->query($insert);
//     $last_id_official_inserted = mysqli_insert_id($conn);

//     //INSERT THE ID OF THE LAST OFFICIAL INSERTED
//     //It has to be inside of a foreach loop because we want to insert the chairmanships in a separate records.
//     foreach ($chairmanship as $chair) {
//         $insert_query_chairmanship = "INSERT INTO tblofficials_chairmanships (`id_officials`, `id_chairmanship`) VALUES ('$last_id_official_inserted', '$chair')";
//         $result_query_chairmanship = $conn->query($insert_query_chairmanship);
//     }

//     if ($result === true) {
//         $_SESSION['message'] = 'Official added!';
//         $_SESSION['success'] = 'success';
//     } else {
//         $_SESSION['message'] = 'Something went wrong!';
//         $_SESSION['success'] = 'danger';
//     }
// } else {

//     $_SESSION['message'] = 'Please fill up the form completely!';
//     $_SESSION['success'] = 'danger';
// }

header("Location: ../officials.php");

$conn->close();
