<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$id                     =   $_POST['mother_id'];

$emergency_name         =   $_POST['emergency_name'];
$emergency_relationship =   $_POST['emergency_relationship'];
$emergency_date         =   $_POST['emergency_date'];
$emergency_cp           =   $_POST['emergency_cp'];
$emergency_landline     =   $_POST['emergency_landline'];

//FOR THE FAMILY NUMBER
$family_num         = $conn->real_escape_string($_POST['family_num']);

if (!empty($family_num)) {
    // Loop through the input arrays
    $query_insert = "INSERT INTO tbl_p_emergency_contact (`emergency_name`, `emergency_relationship`, `emergency_bday`, `emergency_cellphone`, `emergency_landline`, `family_num`) 
                    VALUES ('$emergency_name', '$emergency_relationship', '$emergency_date', '$emergency_cp', '$emergency_landline', '$family_num')";
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
