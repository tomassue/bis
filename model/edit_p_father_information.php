<?php
include('../server/server.php');

if (!isset($_SESSION['username'])) {
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }
}

$id                 =   $_POST['mother_id'];
$father_id          =   $_POST['father_id'];

$id_resident        = $conn->real_escape_string($_POST['id_resident']);
$family_role        = $conn->real_escape_string($_POST['family_role']);
$family_blood_type  = $conn->real_escape_string($_POST['blood_type']);

//FOR THE FAMILY NUMBER
$family_num         = $conn->real_escape_string($_POST['family_num']);

// $emergency_name = $_POST['emergency_name'];
// $emergency_relationship = $_POST['emergency_relationship'];
// $emergency_date = $_POST['emergency_date'];
// $emergency_cp = $_POST['emergency_cp'];
// $emergency_landline = $_POST['emergency_landline'];

if (!empty($id_resident)) {
    // Loop through the input arrays
    $query_update = "UPDATE tbl_p_fam_members
                    SET id_resident = '$id_resident', family_role = '$family_role', family_blood_type = '$family_blood_type', family_num = '$family_num'
                    WHERE family_role = 'father' AND family_num = '$family_num'";
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
